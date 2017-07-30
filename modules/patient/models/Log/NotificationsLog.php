<?php

namespace app\modules\patient\models\Log;

use app\modules\patient\models\Log;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:23
 */
class NotificationsLog extends LogPrototype {
	public $type = Log::TYPE_NOTIFICATIONS;
	public $old;
	public $new;

	public $changes = [];
	public $attributes = [
		'on_scan'   => 'notification_scanned',
		'on_update' => 'notification_updates',
		'text'      => 'notification_by_cell',
		'email'     => 'notification_by_email'
	];

	protected $aggregate = false;

	public function save() {
		$this->loadChanges();
		foreach ($this->attributes as $key => $attribute){
			if ($this->old[$attribute] != $this->new[$attribute]){
				$sign = ($this->new[$attribute])?"+":"-";
				if (isset($this->changes[$key]) && $this->changes[$key] != $sign){
					unset($this->changes[$key]);
				} else {
					$this->changes[$key] = $sign;
				}
			}
		}



		if ($this->changes) {
			$this->model->log_content = $this->getContent();
			return parent::save();
		}
		/*
		else {
			if (!$this->model->isNewRecord){
				$this->model->delete();
			}
		}
		*/
		return true;
	}
}