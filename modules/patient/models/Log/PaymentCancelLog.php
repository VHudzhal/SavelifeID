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
class PaymentCancelLog extends LogPrototype {
	protected $aggregate = false;
	public $type = Log::TYPE_PAYMENT_CANCEL_SUCCESS;
	/** @var boolean */
	public $result;
	/** @var array */
	public $content;
	public $call;

	public function save() {
		if($this->result){
			$this->model->log_type = Log::TYPE_PAYMENT_CANCEL_SUCCESS;
			$this->model->log_content = json_encode($this->content);
		} else {
			$this->model->log_type = Log::TYPE_PAYMENT_CANCEL_FAILURE;
			$this->model->log_content = json_encode($this->content);
		}
		return parent::save();
	}
}