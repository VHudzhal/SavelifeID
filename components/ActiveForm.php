<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 15.03.17
 * Time: 10:39
 */

namespace app\components;


use yii\bootstrap\Html;

class ActiveForm extends \kartik\form\ActiveForm {

	public $errorCssClass = 'has-error';

	/**
	 * @var string
	 */
	public $scenario = 'default';

	public $fieldClass = '\app\components\ActiveField';

//	public $fieldConfig = [];

	/**
	 * @param \yii\base\Model $model
	 * @param string $attribute
	 * @param array $options
	 *
	 * @return ActiveField
	 */
	public function field($model, $attribute, $options = [] ) {
		$this->fieldConfig['class'] = $this->fieldClass;
		return parent::field( $model, $attribute, $options );
	}

	public function init(){
		parent::init();
		if ($this->scenario) {
			echo Html::hiddenInput('form_scenario', $this->scenario);
		}
	}

}