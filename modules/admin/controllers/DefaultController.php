<?php

namespace app\modules\admin\controllers;

use app\models\Maintenance;
use app\modules\admin\models\SendMailForm;
use yii\base\Exception;
use yii\db\Expression;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends \app\modules\admin\components\Controller
{
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['message' => "Welcome to Admin Home Page"]);
    }

	/**
     * Renders the login view for the module
     * @return string
     */
    public function actionLogin()
    {
        return $this->render('login');
    }

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionUsers()
    {
        return $this->render('index', ['message' => "Welcome to Admin Users Page"]);
    }

	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionRemoveMaintenance($id){
    	Maintenance::deleteAll(['id' => $id]);
    	return $this->redirect('/admin/maintenance');
    }
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionMaintenance()
    {
	    $model = new \app\models\Maintenance();

	    if ($model->load(\Yii::$app->request->post())) {
		    $model->next_maintenance_start = date('Y-m-d H:i:s',time() + $model->next_hours*60*60 + $model->next_mins*60);
		    if ($model->validate()) {
			    $model->save();
			    return $this->refresh();
		    }
	    }

	    $models = Maintenance::find()->all();

	    return $this->render('maintenance', [
		    'model' => $model,
		    'models' => $models,
	    ]);
    }

    public function actionParams(){

	    $instance_id = trim(shell_exec('/opt/aws/bin/ec2-metadata --instance-id | cut -d " " -f 2'));
	    $instance_id = $instance_id?$instance_id:'<span class="text-danger">Not set</span>';
	    $env = '<span class="text-danger">Unknown</span>';

	    $pdata = shell_exec('aws ec2 describe-tags --filters');
	    $data = json_decode($pdata);
	    if ($data && isset($data->Tags)) {
		    foreach($data->Tags as $one){
			    if (($one->ResourceId == $instance_id) && ($one->Key == 'ServerEnvironment')){
				    $env = $one->Value;
			    }
		    }
	    }


	    return $this->render('params', [
	    	'instance_id' => $instance_id,
		    'env'         => $env
	    ]);
    }

	public function actionEmail()
	{
		/* Создаем экземпляр класса */
		$model = new SendMailForm();
		/* получаем данные из формы и запускаем функцию отправки contact, если все хорошо, выводим сообщение об удачной отправке сообщения на почту */
		if ($model->load(\Yii::$app->request->post())) {
			$model->send();
		}
		return $this->render('send-mail', [
			'model' => $model,
		]);
	}

	public function actionSubscriptionCoupons(){
		return $this->render('subscription-coupons');
	}

	public function actionGetCoupon(){
		$this->layout = '//ajax';

		$coupon = \Yii::$app->stripe->createCoupon();

		return $this->render('get-coupon', [
			'coupon' => $coupon
		]);
	}
}
