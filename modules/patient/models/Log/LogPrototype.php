<?php

namespace app\modules\patient\models\Log;
use app\modules\patient\models\Patient;
use yii\base\Exception;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:17
 */
class LogPrototype extends \yii\base\Component {
	/**
	 * @var \app\modules\patient\models\Log
	 */
	protected $model;
	protected $aggregate = false;
	/**
	 * @var Patient
	 */
	protected $patient;
	public $type;

	public function init(){
		parent::init();
		if ($this->aggregate) {
			$this->model = \app\modules\patient\models\Log::find()
              ->where(['internal_id' => \Yii::$app->patient->internal_id, 'log_type' => $this->type])
              ->andWhere(['>', 'log_updated', new Expression('NOW() - INTERVAL '.\app\modules\patient\models\Log::AGGREGATE_TIMEOUT.' SECOND')])
              ->orderBy(['log_updated' => SORT_DESC])
              ->one();
		}
		if (!$this->model){
			$this->model = new \app\modules\patient\models\Log();
		}

		$this->model->patients_id = 0;
		$this->model->internal_id = '--unknown--';
		$this->model->practice_id = 0;
		$this->model->emergency_check = 0;
		$this->model->send_notifications = 0;
		$this->model->notified = 0;
		if (!\Yii::$app->request->isConsoleRequest){
			if (!\Yii::$app->patient->isGuest){
				$this->model->internal_id = \Yii::$app->patient->internal_id;
				$this->model->patients_id = \Yii::$app->patient->patients_id;
				$this->patient = \Yii::$app->patient->model;
			}
		}
		$this->model->log_type = $this->type;
	}

	public function save(){
		$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
		$this->model->log_updated = $date_utc->format(\DateTime::W3C);
		if (\Yii::$app->request->isConsoleRequest){
			$this->model->ip_address  = '127.0.0.1';
		} else {
			$this->model->ip_address  = \Yii::$app->request->userIP;
		}
		$result = $this->model->save();
		if (!$result){
			throw new Exception('Save log error: ' . Html::errorSummary($this->model), 500);
		}
		return $result;
	}

	public function loadChanges(){
		if ($this->model->log_content){
			$data = explode(',', $this->model->log_content);
			foreach ($data as $one){
				$sign = substr($one, 0, 1);
				$attr = substr($one, 1);
				if (key_exists($attr, $this->attributes) && in_array($sign, ['+', '-'])){
					$this->changes[$attr] = $sign;
				}
			}
		}
	}

	public function getContent(){
		$content = [];
		foreach ($this->changes as $key => $sign){
			$content[] = $sign.$key;
		}
		return implode(',', $content);
	}

}