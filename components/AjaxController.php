<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 09.03.17
 * Time: 17:30
 */

namespace app\components;


use yii\web\Response;

class AjaxController extends Controller {

	public $response = [
		'result' => true
	];

	public function beforeAction($action) {
		if (!\Yii::$app->request->isAjax) {
			return false;
		}

		$this->layout = 'ajax';
		\Yii::$app->response->format = Response::FORMAT_JSON;

		return parent::beforeAction($action);
	}

	public function setResult($result){
		$this->setResponse('result', $result);
	}

	public function setResponse($key, $value){
		$this->response[$key] = $value;
	}
}