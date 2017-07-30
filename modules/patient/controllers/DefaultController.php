<?php

namespace app\modules\patient\controllers;

use app\components\Helper;
use app\modules\patient\models\ActivateForm;
use app\modules\patient\models\AssetDeletionQueue;
use app\modules\patient\models\EmergencyContacts;
use app\modules\patient\models\EmergencyProfileSummary;
use app\modules\patient\models\EmergencyProfileSummaryLookup;
use app\modules\patient\models\Log\ChangeBillingScheduleLog;
use app\modules\patient\models\Log\ChangeCardLog;
use app\modules\patient\models\Log\EmergencyContactsLog;
use app\modules\patient\models\Log\PaymentCancelLog;
use app\modules\patient\models\Log\SupportSessionLog;
use app\modules\patient\models\Log\TokenStatusLog;
use app\modules\patient\models\OtherPhysicians;
use app\modules\patient\models\Patient;
use app\modules\patient\models\RecordForm;
use app\modules\patient\models\TokenActionLookup;
use app\modules\patient\models\TokenAssociations;
use Aws\Credentials\CredentialProvider;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use yii\base\Exception;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Default controller for the `patient` module
 */
class DefaultController extends \app\modules\patient\components\Controller
{
	public $publicActions = [
		'activate',
		'activate-account',
	];

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSetStatus(){
	    $errMessage = 'Error occurred. Please contact support@savelifeid.com for assistance';
	    $status = \Yii::$app->request->post('status', false);
		    switch ($status){
			    case Patient::STATUS_PAUSED:
			    case Patient::STATUS_ACTIVE:
			    	\Yii::$app->patient->model->status = $status;
				    \Yii::$app->patient->model->save();

			        return \Yii::$app->response->redirect('/subscriber-home/account-status');

//				    return $this->renderPartial('__account_subscription_status/'.$status);
			    	break;
			    case Patient::STATUS_CANCEL:
			    	$subscription = \Yii::$app->stripe->getSubscribe();
			    	if (\Yii::$app->stripe->cancelSubscription($subscription)){
					    $log = new PaymentCancelLog(['result'=>true, 'content' => $subscription]);
					    \Yii::$app->patient->model->delete();
					    $log->save();
					    \Yii::$app->patient->logout();
					    \Yii::$app->response->redirect('/');
			    	} else {
					    (new PaymentCancelLog(['result'=>false, 'content' => [
						    'subscription' => $subscription,
						    'error' => \Yii::$app->stripe->getErrors()
					    ]]))->save();
			    		$errMessage = "Transaction failed. Please contact support@savelifeid.com for assistance.";
				    }
				    break;
		    }
		Helper::showError($errMessage);
		\Yii::$app->end(500);
    }

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionActivate($register)
    {
	    $model = new ActivateForm();
	    if ($register) {
	    	$model->setScenario(ActivateForm::SCENARIO_REGISTER);
	    }

     	$model->loadFromSlid(\Yii::$app->request->get('slid', false));

     	if (!$model->loaded) {
     		throw new NotFoundHttpException();
        }

	    if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
     		$model->patient->password = $model->password;
		    $model->patient->display_by_default = $model->display_all ? 1 : 0;
		    if (!$model->patient->save()) {
		    	throw new Exception(strip_tags(Html::errorSummary($model)), 500);
		    }
		    \Yii::$app->patient->register($model->patient);
		    \Yii::$app->patient->login($model->email, $model->password);
		    return $this->redirect('/activate-complete-registration');
	    } else {
		    \Yii::$app->patient->logout();
	    }
	    return $this->render('activate', ['model' => $model]);
    }

    public function actionActivateCompleteRegistration(){
	    if (\Yii::$app->patient->completed_registration_date){
	    	return $this->redirect('/subscriber-home');
	    }

	    $model = new RecordForm();

	    if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
		    if ($model->validate()){
			    $result = $model->save();
		    } else {
			    $result = false;
		    }
		    \Yii::$app->response->format = Response::FORMAT_JSON;
		    return [
			    'result' => $result,
			    'errors' => $model->getErrors()
		    ];
	    }

	    return $this->render('activate-complete-registration', ['model' => $model]);
    }

    public function actionConfirmRequest(){
	    $model = \Yii::$app->patient->model;
	    $model->support_request = 1;

	    (new SupportSessionLog(['result' => true, 'patient_id' => $model->patients_id]))->save();

	    if (!$model->save()) {
		    throw new HttpException(500, strip_tags(Html::errorSummary($model)));
	    }
	    \Yii::$app->session->setFlash('support-confirmation', 'Support session has been confirmed.');
	    return $this->redirect('/subscriber-home/account#support');
    }

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionAccount()
    {
    	$this->layout = '//account';
	    $model = \Yii::$app->patient->model;

	    if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()) && $model->validate()){
	    	if ($model->save()) {
			    \Yii::$app->session->setFlash('success', 'Information updated successfully');
			    return $this->redirect(['account']);
		    }
	    }
	    return $this->render('account', ['model' => $model]);
    }
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionAccountCancel()
    {
	    $this->layout = '//account';
	    return $this->render('account-cancel');
    }
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionAccountStatus($popup = false)
    {
	    if ($popup && \Yii::$app->request->isAjax){
		    $data = [];
		    $this->layout = '//ajax';
		    switch($popup){
			    case 'ReviewBillingScheduleModal':
			    	$template = '__review_billing_schedule';
				    break;
			    case 'ReviewPaymentMethodModal':
			    	$template = '__review_payment_method';
				    break;
			    case 'ChangePaymentMethodModal':
			    	$template = '__change_payment_method';
				    break;
			    case 'paymentContest':
			    	$template = '__payment_contest';
				    break;
			    case 'paymentDetails':
			    	$template = '__payment_details';
				    $pid = \Yii::$app->request->get('pid');
			    	$data['payment'] = \Yii::$app->stripe->getPayment($pid);
				    break;
			    default:
			    	throw new HttpException(404, 'Popup Layout Not Found');
		    }
		    return $this->render('__account_subscription_status/_modal/'.$template, $data);
	    } else {
	        $this->layout = '//account';
		    return $this->render('account-status');
	    }
    }
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionAccountSecurity()
    {
    	$this->layout = '//account';
	    $model = \Yii::$app->patient->model;

	    if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()) && $model->validate()){
	    	if ($model->save()) {
			    \Yii::$app->session->setFlash('success', 'Information updated successfully');
			    return $this->redirect(['account']);
		    }
	    }

	    $changePasswordModel = new \app\modules\patient\models\ChangePasswordForm();

	    if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost ){
		    $this->layout = '//ajax';
		    $scenario = \Yii::$app->request->post('form_scenario', false);
		    switch ($scenario){
			    case 'change-password':
			    	$changePasswordModel->load(\Yii::$app->request->post());
			    	if ($changePasswordModel->validate()){
					    $changePasswordModel->save();

					    $changePasswordModel->old_password = '';
					    $changePasswordModel->password = '';
					    $changePasswordModel->password_repeat = '';

					    return $this->render('__change_password_form__password_changed.php', ['model' => $changePasswordModel]).
					           $this->render('__change_password_form.php', ['model' => $changePasswordModel]);
				    }
				    return $this->render('__change_password_form.php', ['model' => $changePasswordModel]);
			    	break;
		    }

		    throw new HttpException(404, 'Method not found');
	    }

	    return $this->render('account-security', [
		    'model' => $model,
		    'changePasswordModel' => $changePasswordModel,
	    ]);
    }
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionAccountSupport()
    {
    	$this->layout = '//account';
	    $model = \Yii::$app->patient->model;

	    if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()) && $model->validate()){
	    	if ($model->save()) {
			    \Yii::$app->session->setFlash('success', 'Information updated successfully');
			    return $this->redirect(['account']);
		    }
	    }

	    return $this->render('account-support', [
		    'model' => $model,
	    ]);
    }
    public function actionPreviousPayments(){
	    $this->layout = '//account';
	    $data = \Yii::$app->stripe->getPreviousPayments();

	    foreach ($data as $i => $one){
		    $data[$i]['plan'] = '-';
		    $_data = \Stripe\Invoice::retrieve($data[$i]['invoice']);
		    if ($_data && $_data->lines && $_data->lines->data){
			    $_data = array_pop($_data->lines->data);
			    if ($_data && $_data->plan && $_data->plan->name){
				    $data[$i]['plan'] = $_data->plan->name;
			    }
		    }
	    }


	    $provider = new ArrayDataProvider([
		    'allModels' => $data,
		    'sort' => [
			    'attributes' => ['created', 'amount', 'plan'],
		    ],
		    'pagination' => [
			    'pageSize' => 10,
		    ],
	    ]);

	    return $this->render('previous-payments', [
		    'provider' => $provider,
		    'data' => $data
	    ]);
    }
    public function actionSwitchPlan(){
    	$this->layout = '//ajax';
    	$id = \Yii::$app->request->post('id', 0);

    	$subscription = \Yii::$app->stripe->getSubscribe();

    	try{
		    $subscription = \Stripe\Subscription::retrieve($subscription->id);
		    $subscription->plan = $id; // или SaveLifeMonthly
		    $subscription->prorate = false;
		    $subscription->trial_end = \Yii::$app->stripe->getNextPaymentDate()-1;
		    $subscription->save();
		    (new ChangeBillingScheduleLog(['result' => true, 'content' => $subscription]))->save();
	    } catch(\Exception $e){
		    (new ChangeBillingScheduleLog(['call' => '\Stripe\Subscription::save', 'result' => false, 'content' => $e->getMessage()]))->save();
		    echo('<div class="alert alert-danger">Something went wrong, please reach uot support to resolve this issue.</div>');
		    \Yii::$app->end();
	    }
	    return $this->render('__account_subscription_status/_modal/__switchPlan');
    }

    public function actionChangeCard(){
    	$this->layout = '//ajax';

    	$no    = \Yii::$app->request->post('cc_no');
	    $month = \Yii::$app->request->post('cc_month');
    	$year  = \Yii::$app->request->post('cc_year');
    	$cvv   = \Yii::$app->request->post('cc_cvv');

    	try{
		    $customer = \Yii::$app->stripe->retriveCustomerData();
		    $token = \Stripe\Token::create([
			    "card" => [
				    "number" => $no,
				    "exp_month" => $month,
				    "exp_year" => $year,
				    "cvc" => $cvv
			    ]
		    ]);

		    if ($token->id) {
				// Add a new card to the customer
			    $card = $customer->sources->create(['source' => $token->id]);

				// Set the new card as the customers default card
				$customer->default_source = $card->id;
				$customer->save();
			    (new ChangeCardLog(['result' => true, 'content' => $token]))->save();

		    } else {
			    (new ChangeCardLog(['call' => '\Stripe\Token::create', 'result' => false, 'content' => $token]))->save();
			    throw new Exception("Wrong card data given.", 500);
		    }
	    } catch(\Exception $e){
		    (new ChangeCardLog(['call' => '\Stripe\Token::create', 'result' => false, 'content' => $e->getMessage()]))->save();
		    echo('<div class="alert alert-danger">'.$e->getMessage().'</div>');
			return $this->render('__account_subscription_status/_modal/__change_payment_method', ['partial' => true]);
	    }
	    return $this->render('__account_subscription_status/_modal/__payment_method_changed', [
	    	'card' => $card,
	    ]);
    }

    public function actionReactivate(){
    	$this->layout = '//ajax';

    	// Add credit card
	    $no    = \Yii::$app->request->post('cc_no');
	    $month = \Yii::$app->request->post('cc_month');
    	$year  = \Yii::$app->request->post('cc_year');
    	$cvv   = \Yii::$app->request->post('cc_cvv');

    	if ($no) {
		    try{
			    $customer = \Yii::$app->stripe->retriveCustomerData();
			    if ($customer) {
				    $token = \Stripe\Token::create([
					    "card" => [
						    "number" => $no,
						    "exp_month" => $month,
						    "exp_year" => $year,
						    "cvc" => $cvv
					    ]
				    ]);

				    if ($token->id) {
					    // Add a new card to the customer
					    $card = $customer->sources->create(['source' => $token->id]);

					    // Set the new card as the customers default card
					    $customer->default_source = $card->id;
					    $customer->save();
					    (new ChangeCardLog(['result' => true, 'content' => $token]))->save();

				    } else {
					    (new ChangeCardLog(['call' => '\Stripe\Token::create', 'result' => false, 'content' => $token]))->save();
					    throw new Exception("Wrong card data given.", 500);
				    }
			    } else {
				    echo('<div class="alert alert-danger hidden">No customer given</div>');
				    echo('<div class="alert alert-danger">Something went wrong, please contact support.</div>');
				    return $this->render('__account_subscription_status/_modal/__reactivate', ['partial' => true]);
			    }
		    } catch(\Exception $e){
			    (new ChangeCardLog(['call' => '\Stripe\Token::create', 'result' => false, 'content' => $e->getMessage()]))->save();
			    echo('<div class="alert alert-danger hidden">1 '.$e->getMessage().'</div>');
			    echo('<div class="alert alert-danger">Something went wrong, please contact support.</div>');
			    return $this->render('__account_subscription_status/_modal/__reactivate', ['partial' => true]);
		    }

		    // Change Plan
		    $id = \Yii::$app->request->post('plan_id', 0);
		    $subscription = \Yii::$app->stripe->getSubscribe(true);
		    try{
			    if (!$subscription) {
				    $subscription = \Stripe\Subscription::create(array(
					    "customer" => $customer->id,
					    "plan" => $id,
					    "prorate" => false
				    ));
			    } else {
				    $subscription = \Stripe\Subscription::retrieve($subscription->id);
				    $subscription->plan = $id; // или SaveLifeMonthly
				    $subscription->prorate = false;
				    $subscription->save();
			    }
			    (new ChangeBillingScheduleLog(['result' => true, 'content' => $subscription]))->save();

			    echo('
<div class="alert alert-success">Account is successfully reactivated.</div>
<script type="text/javascript">
    $(document).ready(function(){
		$("#reactivateModal").on("hidden.bs.modal", function () {
		    document.location.href = document.location.href;
		});
      
		$("#reactivateModal .modal-footer").html("<button type=\'button\' class=\'btn btn-default\' data-dismiss=\'modal\'>OK</button>");
    });
</script>
');
			    \Yii::$app->patient->model->status = Patient::STATUS_ACTIVE;
			    \Yii::$app->patient->model->save();
			    \Yii::$app->end();

		    } catch(\Exception $e){
			    (new ChangeBillingScheduleLog(['call' => '\Stripe\Subscription::save', 'result' => false, 'content' => $e->getMessage()]))->save();
			    echo('<div class="alert alert-danger hidden">2 '.$e->getMessage().'</div>');
			    echo('<div class="alert alert-danger">Something went wrong, please contact support.</div>');
			    return $this->render('__account_subscription_status/_modal/__reactivate', ['partial' => true]);
		    }
		    /*
			try {
				$invoice = \Yii::$app->stripe->createInvoice();
				if ($invoice) {
					echo('
	<div class="alert alert-success">Account is successfully reactivated.</div>
	<script type="text/javascript">
		$("#reactivateModal").on("hidden.bs.modal", function () {
			document.location.href = document.location.href;
		});
	</script>
	');
					\Yii::$app->end();
				} else {
					echo('<div class="alert alert-danger">3 '.implode(', ', \Yii::$app->stripe->getErrors()).'</div>');
					echo('<div class="alert alert-danger">Something went wrong, please contact support.</div>');
					\Yii::$app->end();
				}
			} catch(\Exception $e){
				echo('<div class="alert alert-danger">4 '.$e->getMessage().'</div>');
				echo('<div class="alert alert-danger">Something went wrong, please contact support.</div>');
				\Yii::$app->end();
			}
			*/
	    }

	    return $this->render('__account_subscription_status/_modal/__reactivate', [
	    	'partial' => true,
	    ]);

    }
    public function actionOverdue(){
    	$this->layout = '//ajax';
	    return $this->render('overdue');
    }
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionEmergencyContacts(){
        return $this->render('emergency-contacts');
    }
    public function actionAddEmergencyContact(){
	    $model = new EmergencyContacts();
	    $model->internal_id = \Yii::$app->patient->internal_id;
	    $content = '';
	    $result = true;
	    $errors = [];

	    $queue = \Yii::$app->request->post('queue', '{}');
	    $queue = json_decode($queue);
	    if (is_array($queue)){
	    	foreach($queue as $one) {
			    $data = $this->convertData($one->data);
			    if ($model->load($data) && $model->validate()){
				    $model->added_by_user = 1;
				    $model->display = 1;
				    $result &= $model->save();
				    if ($result){
					    (new EmergencyContactsLog([
						    'contact' => $model,
						    'actionType' => 'AddContact'
					    ]))->save();
					    $content .= $this->renderPartial('__record/emergency-contacts/____emergency-contact-item', ['model' => $model]);
				    } else {
					    $errors += $model->getErrors();
				    }
			    } else {
				    $result = false;
				    $errors += $model->getErrors();
			    }
		    }
	    }

	    \Yii::$app->response->format = Response::FORMAT_JSON;
	    return [
		    'result'  => $result,
		    'errors'  => $errors,
		    'content' => $content
	    ];
    }
    public function actionAddPhysician(){
    	$model = new OtherPhysicians();
    	$model->internal_id = \Yii::$app->patient->internal_id;
	    $content = '';

    	if ($model->load(\Yii::$app->request->post()) && $model->validate()){
		    $result = $model->save();
		    if ($result){
			    $content = $this->renderPartial('__record/other-physicians/____physicians-contact-info-item', ['item' => $model]);
		    }
	    } else {
    		$result = false;
	    }
	    \Yii::$app->response->format = Response::FORMAT_JSON;
	    return [
		    'result'  => $result,
		    'errors'  => $model->getErrors(),
		    'content' => $content
	    ];
    }
    public function actionDelPhysician($id){
	    $result = OtherPhysicians::deleteAll(['internal_id' => \Yii::$app->patient->internal_id, 'physician_id' => $id]);
	    \Yii::$app->response->format = Response::FORMAT_JSON;
	    return [
		    'result'  => $result
	    ];
    }
    public function actionDelEmergencyContact($id){
	    $model = EmergencyContacts::findOne(['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $id]);
	    $result = EmergencyContacts::deleteAll(['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $id]);
	    \Yii::$app->response->format = Response::FORMAT_JSON;
	    (new EmergencyContactsLog([
		    'contact' => $model,
		    'actionType' => 'DeleteContact'
	    ]))->save();
	    return [
		    'result'  => $result
	    ];
    }
    /*
     * Renders the index view for the module
     * @return string
     */
    public function actionRecord(){
    	if (\Yii::$app->patient->status == Patient::STATUS_CANCEL) {
    		return $this->redirect('/subscriber-home/account-status');
	    }
	    $model = new RecordForm();
	    if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost){
		    $result = true;
		    $errors = [];

		    $queue = \Yii::$app->request->post('queue', '{}');
		    $queue = json_decode($queue);
		    if (is_array($queue)){
			    foreach($queue as $one) {
				    $data = $this->convertData($one->data);
				    if (isset($data['form_scenario'])){
				    	$model->scenario = $data['form_scenario'];
				    }
				    if ($model->load($data)) {
					    if ($model->validate()){
						    $result &= $model->save();
					    } else {
						    $result = false;
						    $errors += $model->getErrors();
					    }
				    } else {
					    $errors += $model->getErrors();
				    }
			    }
		    } else {
		    	$result = false;
		    	$errors[] = 'Empty data received.';
		    }
		    \Yii::$app->response->format = Response::FORMAT_JSON;
		    \Yii::$app->patient->model->refresh();
		    return [
			    'result' => $result,
			    'errors' => $errors,
			    'displayAll' => \Yii::$app->patient->model->display_by_default
		    ];
	    }

        return $this->render('record', ['model' => $model]);
    }
    public function actionCompleteRegistration(){
	    \Yii::$app->patient->model->completed_registration_date = new Expression("NOW()");
	    \Yii::$app->patient->model->status = Patient::STATUS_ACTIVE;
	    \Yii::$app->patient->model->save();
	    return $this->redirect('/subscriber-home');
    }
    public function actionDeactivateToken(){
    	if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost){
		    $token_id = \Yii::$app->request->post('token', false);
		    $token = TokenAssociations::findOne($token_id);
		    if ($token){
		    	if ($token->patient_id == \Yii::$app->patient->patients_id){
		    		$token->active = 0;
				    $token->save();
		    		return $this->renderPartial('__account_cancel_lost_card__active', ['model' => $token]);
			    } else throw new HttpException(403, 'Operation not permitted');
		    } else throw new HttpException(404, 'Token not found');
	    } else return $this->redirect('/');
    }
    public function actionActivateToken(){
    	if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost){
		    $token_id = \Yii::$app->request->post('token', false);
		    $token = TokenAssociations::findOne($token_id);
		    if ($token){
		    	if ($token->patient_id == \Yii::$app->patient->patients_id){
		    		$token->active = 1;
				    $token->save();
		    		return $this->renderPartial('__account_cancel_lost_card__active', ['model' => $token]);
			    } else throw new HttpException(403, 'Operation not permitted');
		    } else throw new HttpException(404, 'Token not found');
	    } else return $this->redirect('/');
    }
    public function actionPreviewImage($url){
    	$this->layout = '//ajax';
    	$url = base64_decode($url);
	    return $this->render('preview_image', ['url' => $url]);
    }
	public function actionUploadProfile(){
		$imageFile = UploadedFile::getInstanceByName('profile-image');
		if ($imageFile) {
			if ($content = file_get_contents($imageFile->tempName)) {

				$finfo = new \finfo(FILEINFO_MIME);
				$info = $finfo->buffer($content);
				$info = explode(';', $info);
				$info = $info[0];
				if (!in_array($info, [
					'image/png',
					'image/jpg',
					'image/jpeg',
					'image/gif',
					'image/bmp',
				])){
					\Yii::$app->response->format = Response::FORMAT_JSON;
					return [
						'error' => 'Wrong file format!'
					];
				}

				$config = [
					'region'       => getenv('BUCKET_IMAGE_REGION'),
					'version'      => 'latest',
				];
				if (($bsecret = getenv('BUCKET_SECRET_KEY')) && ($bkey = getenv('BUCKET_ACCESS_KEY')) ){
					$credentials = new Credentials($bkey, $bsecret);
					$config['credentials'] = $credentials;
				}

				$s3 = S3Client::factory($config);

				$fileName = sha1(uniqid(\Yii::$app->patient->internal_id, true)). '.' . $imageFile->extension;
				$key = Helper::getS3BucketRoot().\Yii::$app->patient->internal_id.'/picture/'.$fileName;
				$s3->putObject([
					'Bucket'       => getenv('BUCKET_IMAGE'),
					'Key'          => $key,
					'Body'         => $content,
					'ContentType'  => mimetype_from_filename($fileName),
					'ACL'          => 'private',
					'ServerSideEncryption' => 'AES256',
				]);

				AssetDeletionQueue::add('s3://'.getenv('BUCKET_IMAGE').'/'.$key);

				\Yii::$app->patient->model->picture = $fileName;
				\Yii::$app->response->format = Response::FORMAT_JSON;
				return [
					'url' => \Yii::$app->patient->model->getPhoto(),
					'filename' => $fileName
				];
			}
		}
		return '';
	}

	private function convertData($source){
		$result = [];
		foreach ($source as $one){
			if ($index = strpos($one->name, '[')){
				$indexes = explode('[', $one->name);
				$indexes = array_map(function($item){ return str_replace(']', '', $item); }, $indexes);
				$result = $this->convertArray($result, $indexes, $one->value);
			} else {
				$result[$one->name] = $one->value;
			}
		}
		return $result;
	}
	private function convertArray($array, $indexes, $value){
		$ret = $value;
		$indexes = array_reverse($indexes);
		foreach($indexes as $one){
			if ($one) {
				$ret = [$one => $ret];
			} else {
				$ret = [$ret];
			}
		}
		$array = ArrayHelper::merge($array, $ret);
		return $array;
	}
}
