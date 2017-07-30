<?php

namespace app\modules\patient\controllers;

use app\models\RegisterForm;
use app\modules\patient\models\ActivateForm;
use app\modules\patient\models\ChangePasswordForm;
use app\modules\patient\models\Patient;
use app\modules\patient\models\SlidLookup;
use app\modules\patient\models\TokenAssociations;
use yii\base\Exception;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `patient` module
 */
class RegisterController extends \app\components\Controller
{

	public function beforeAction( $action ) {
		$subMenu = array('index'=>array('step'=>1,'link'=>'/','name'=>'Account'),
		                 'billing'=>array('step'=>2,'link'=>'/billing/','name'=>'Billing'),
		                 'profile'=>array('step'=>3,'link'=>'/profile/','name'=>'Profile'),
		                 'history'=>array('step'=>4,'link'=>'/history/','name'=>'History'),
		                 'optional'=>array('step'=>5,'link'=>'/optional/','name'=>'Optional'),
		                 'manage'=>array('step'=>6,'link'=>'/manage/','name'=>'Manage'));

		\Yii::$app->view->params['submenu'] = '';
		foreach ($subMenu as $page=>$dt) {
			$active = ($page==$action->id)?' class="active"':'';
			\Yii::$app->view->params['submenu'] .= '<li'.$active.'><a href="/register'.$dt['link'].'"><span class="glyphicon glyphicon-chevron-right"></span>'.$dt['name'].'</a></li>';
		}


		return parent::beforeAction( $action ); // TODO: Change the autogenerated stub
	}

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
	    $model = new Patient();
	    $formModel = new RegisterForm();
    	if (\Yii::$app->request->isPost){
		    $model = Patient::findOne(['internal_id' => \Yii::$app->request->post('slid')]);
    		if ($model) {
    			if ($model->validate()){
				    $token = TokenAssociations::findOne([
					    'token_slid' => \Yii::$app->request->post('slid'),
					    'patient_id' => $model->patients_id
				    ]);
				    if (!$token){
					    return $this->redirect('/register-account?slid='.$model->internal_id_hash);
				    } else {
					    $formModel->addError('internal_id', 'Account already registered, please sign in');
				    }
			    } else {
    				$formModel->addErrors($model->errors);
			    }
		    } else {
			    $model = new Patient();
			    $formModel->addError('internal_id', 'No enrolling user exists with given SLID#');
		    }
	    }
	    return $this->render('index', ['model' => $model, 'formModel' => $formModel]);
    }

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionBilling()
    {
        return $this->render('billing');
    }

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionProfile()
    {
        return $this->render('profile');
    }
    public function actionHistory()
    {
        return $this->render('history');
    }
    public function actionOptional()
    {
        return $this->render('optional');
    }
    public function actionManage()
    {
	    return $this->render('manage');
    }

    public function actionForgot($slid, $key){
	    $patient = Patient::find()->where('md5(internal_id) = :slid', [':slid' => $slid])->one();
	    /** @var $patient Patient */
	    if ($patient && md5($patient->salt) == $key) {
                $resetPasswordLinkExpirationDate = \DateTime::createFromFormat('Y-m-d H:i:s', $patient->link_exp_date);
                $currentDateTime = new \DateTime();
                if($currentDateTime > $resetPasswordLinkExpirationDate) {
                    throw new HttpException(410, 'Link expired. Please restore your password again.');
                }
                
                $model = new ChangePasswordForm();
		    $model->setScenario(ChangePasswordForm::SCENARIO_FORGOT);
	    	if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){

		        if ($model->validate()){
		            $patient->setModelSalt();
				    $patient->password = $patient->generatePasswordHash($model->password);
				    if ($patient->save()){
					    return $this->renderPartial('change_password_ok');
				    } else {
					    $model->addErrors($patient->getErrors());
				    }
			    } else {
			        $model->addErrors($patient->getErrors());
		        }
		        $this->layout = '//ajax';
			    return $this->renderPartial('forgot', ['model' => $model]);
		    }
		    return $this->render('forgot', ['model' => $model]);
	    } else throw new HttpException(404, 'No user has been found');
    }
}