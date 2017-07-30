<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 11:22
 */

namespace app\components\mail;


use app\models\MailQueue;
use yii\helpers\ArrayHelper;

class prototype extends MailQueue {
	public $defaults = [
		'attempts' => 0
	];

	public function init(){
		parent::init();
		if ($this->isNewRecord) {
			$this->send_time = date(DATE_W3C);
			foreach ($this->defaults as $key => $value){
				$this->$key = $value;
			}
		}
	}

	public function executeCallback(){
		if ($this->callback){
			if (class_exists($this->callback)){
				if (is_subclass_of($this->callback, '\app\components\mail\callback\prototype')){
					$className = $this->callback;
					$callback = new $className($this);
					/** @var $callback \app\components\mail\callback\prototype */
					if (method_exists($callback, 'run')){
						$callback->run();
					} else $this->addError('callback', 'Callback "run" method absent: '.$this->callback);
				} else $this->addError('callback', 'Callback has wrong definition: '.$this->callback);
			} else $this->addError('callback', 'Callback class not found: '.$this->callback);
		} else $this->addError('callback', 'Callback not defined in database: '.$this->callback);
	}

	public function setData($data){
		$this->data = $data;
	}

	public function asFlatArray($data){
		if (is_object($data)){
			if (method_exists($data, 'keys')){
				$ret = [];
				$keys = $data->keys();
				foreach ($keys as $key){
					if (!is_object($data->$key)){
						$ret[$key] = $data->$key;
					}
				}
				return $ret;
			}
			if (method_exists($data, '__toArray')){
				return $data->__toArray();
			}
		}
		return ArrayHelper::toArray($data);
	}
}