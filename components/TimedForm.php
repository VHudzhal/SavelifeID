<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 01.06.17
 * Time: 9:53
 */

namespace app\components;


use yii\base\Model;
use yii\helpers\Html;

class TimedForm extends Model {

	public $id;
	public $timeLimit = 60;
	public $timeInterval = 3600;
	public $triesCount = 3;
	public $maxTriesCount = 3;
	public $maxTriesCountAttribute = 'tries-error';
	public $triesErrorMessage = 'Too many attempts, please try in {time} seconds.';
	public $checkTries = true;

	public $sessionKey;
	public $sessionTimeoutKey;

	public function init(){
		parent::init();
		$this->sessionKey = $this->sessionKey?$this->sessionKey:'tries-'.$this->id;
		$this->sessionTimeoutKey = $this->sessionKey.'-timeout';
	}

	public function afterValidate(){
		$this->validateTimeout(true);
		parent::afterValidate();
	}


	public function validateTimeout($clearErrors = false){
		if (!$this->checkTries) return;
		$this->triesCount = (int)\Yii::$app->guestSession->get($this->sessionKey, 0);
		if ($this->isExpired()) {
			if ($clearErrors) {
				$this->clearErrors();
			}
			$message = str_replace("{time}", $this->getExpire(), $this->triesErrorMessage);
			$this->addError($this->maxTriesCountAttribute, $message);
		} else {
			\Yii::$app->guestSession->set($this->sessionKey, ++$this->triesCount, time() + $this->timeInterval);
		}
	}

	public function isExpired(){
		$expired = ($this->triesCount > $this->maxTriesCount);


		if ($expired){
			if ( \Yii::$app->guestSession->get($this->sessionTimeoutKey, 0) < time()){
				\Yii::$app->guestSession->set($this->sessionTimeoutKey, time() + $this->timeLimit, time() + $this->timeLimit);
				$expired = false;
			}
		}

		return $expired;
	}

	public function getExpire(){
		return \Yii::$app->guestSession->getExpire($this->sessionTimeoutKey);
	}

}