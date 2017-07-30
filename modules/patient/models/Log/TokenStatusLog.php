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
class TokenStatusLog extends LogPrototype {
	protected $aggregate = false;
	public $type = Log::TYPE_TOKEN_STATUS_CHANGE;
	/** @var TokenAssociations */
	public $token;

	public function save() {
		switch($this->token->active){
			case 1:
				$status = "activated";
				break;
			case 0:
				$status = "deactivated";
				break;
			default:
				$status = 'undefined';
		}
		$this->model->log_content = ucfirst($this->token->type->text).' '.$this->token->token_slid.' '.$status;
		return parent::save();
	}
}