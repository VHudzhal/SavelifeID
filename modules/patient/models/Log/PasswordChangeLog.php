<?php

namespace app\modules\patient\models\Log;

use app\modules\patient\models\Log;
use app\modules\patient\models\TokenActionLookup;
use app\modules\patient\models\TokenAssociations;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:23
 */
class PasswordChangeLog extends LogPrototype {
	protected $aggregate = false;
	public $type = Log::TYPE_PASSWORD_CHANGE;
	public $current_patient;

	public function save() {
        $this->model->log_content = '';
        $this->model->patients_id = $this->current_patient->patients_id;
        $this->model->internal_id = $this->current_patient->internal_id;
		return parent::save();
	}
}