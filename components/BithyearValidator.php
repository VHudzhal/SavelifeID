<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 12.06.17
 * Time: 17:18
 */

namespace app\components;
use yii\validators\Validator;


class BithyearValidator extends Validator {
	public function init()
	{
		parent::init();
		$this->message = 'Incorrect birth year entered.';
	}

	public function validateAttribute($model, $attribute){
	}

	public function clientValidateAttribute($model, $attribute, $view)
	{
		$message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		return <<<JS
if ($.inArray(value.length, [2,4]) === -1) {
    messages.push($message);
}
JS;
	}
}