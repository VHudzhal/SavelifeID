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
class S3DeletionErrorLog extends LogPrototype {
	protected $aggregate = false;
	public $type = Log::TYPE_S3_DELETION;
	public $s3url = '';
	public $error = '';

	public function save() {
		$chains = explode('://', $this->s3url);
		$chains = explode('/', $chains[1]);
		if (isset($chains[2])) {
			$this->model->internal_id = $chains[2];
		}
		$patient = Patient::findOne(['internal_id' => $this->model->internal_id]);
		if ($patient) {
			$this->model->patients_id = $patient->patients_id;
		}

		$this->model->log_content = json_encode([
			's3_url'    => $this->s3url,
			'status'    => 'failure',
			'errormsg'  => $this->error
		]);
		return parent::save();
	}
}