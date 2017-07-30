<?php

namespace app\modules\patient\models\Log;

use app\modules\patient\models\Log;
use app\modules\patient\models\Patient;
use app\modules\patient\models\TokenActionLookup;
use app\modules\patient\models\TokenAssociations;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:23
 */
class SupportSessionLog extends LogPrototype {
	protected $aggregate = false;
	public $type = Log::TYPE_SUPPORT_IDENTITY_CHECK;
	public $result = false;
	public $patient_id = false;

	public function init(){
		if (!$this->result) {
			$this->model = false;
		} else {
			$this->model = Log::find()
			                  ->where(['patients_id' => \Yii::$app->patient->patients_id, 'log_type' => $this->type])
			                  ->orderBy(['log_updated' => SORT_DESC])
			                  ->one();
			if ($this->model && $this->model->log_content){
				$data = json_decode($this->model->log_content, true);
				if (is_array($data) && isset($data['result'])) {
					if ($data['result']) {
						$this->model = false;
					}
					// We have last record with false result
				} else {
					$this->model = false;
				}
			} else {
				$this->model = false;
			}
		}
		parent::init();
	}

	public function save() {
		$admin_email = \Yii::$app->patient->email;
		$user_ip     = null;
		if (!$this->model->isNewRecord){
			$user_ip = \Yii::$app->request->userIP;
			$data = json_decode($this->model->log_content, true);
			if (is_array($data)) {
				$admin_email = isset($data['admin'])?$data['admin']:"Unknown";
			}
		}

		$patient = Patient::findOne(['patients_id' => $this->patient_id]);

		$data = [
			"method" => "login",
			"result" => $this->result,
			"admin" => $admin_email,
			"user_ip" => $user_ip
		];
		$this->model->log_content = json_encode($data);
		$this->model->internal_id = $patient->internal_id;
		$this->model->patients_id = $patient->patients_id;
		return parent::save();
	}
}