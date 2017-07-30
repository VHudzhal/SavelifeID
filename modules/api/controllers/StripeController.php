<?php

namespace app\modules\api\controllers;

use app\models\Maintenance;
use app\modules\admin\models\SendMailForm;
use yii\base\Exception;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class StripeController extends \yii\web\Controller
{
	const OK = 'Ok';

	public $enableCsrfValidation = false;
	public $layout = '//ajax';
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionWebhook(){
    	\Yii::$app->response->format = Response::FORMAT_RAW;
	    \Yii::$app->stripe->processEvent();
	    if (\Yii::$app->stripe->isError()){
		    $errors = implode("\r\n\.", \Yii::$app->stripe->getErrors());
	    	echo $errors;
		    throw new HttpException(400, $errors);
	    }
	    return 'Ok';
    }
}
