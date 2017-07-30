<?php

namespace app\modules\patient\models\Log;

use app\modules\patient\models\Log;

/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 13:23
 */
class ProfileItemVisibilityLog extends LogPrototype {
	public $type = Log::TYPE_PROFILE_ITEM_VISIBILITY_CHANGE;
	public $old;
	public $new;
	public $category;

	public $changes = [];
	public $attributes = [];

	protected $aggregate = false;

	public function save() {
		$this->loadChanges();
		$this->prepareForComparsion();

		foreach ($this->old as $key => $old_sign){
			$this->process($key);
		}
		foreach ($this->new as $key => $new_sign){
			if (!isset($this->old[$key])){
				$this->process($key);
			}
		}

		if ($this->changes) {
			$this->model->log_content = $this->getContent();
			return parent::save();
		} else {
			if (!$this->model->isNewRecord){
				$this->model->delete();
			}
			return true;
		}
	}

	public function process($key){
		$old_sign = (isset($this->old[$key]))?'+':'-';
		$new_sign = (isset($this->new[$key]))?'+':'-';
		if ($old_sign != $new_sign){
			if (isset($this->changes[$key]) && $this->changes[$key] != $new_sign){
				unset($this->changes[$key]);
			} else {
				$this->changes[$key] = $new_sign;
			}
		}
	}

	public function loadChanges(){
		if ($this->model->log_content){
			$data = explode(',', $this->model->log_content);
			foreach ($data as $one){
				$sign = substr($one, 0, 1);
				$attr = substr($one, 1);
				if (in_array($sign, ['+', '-'])){
					$this->changes[$attr] = $sign;
				}
			}
		}
	}

	protected function prepareForComparsion(){
		$this->_prepareForComparsion('new');
		$this->_prepareForComparsion('old');
	}
	protected function _prepareForComparsion($el){
		$data = $this->$el;
		$this->$el = [];
		foreach ($data as $one){
			$this->$el[$this->category.' '.$one->name] = $one->display?"+":"-";
		}
	}
}