<?php

namespace app\models;

use app\components\TimedForm;
use app\modules\patient\models\Patient;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends TimedForm
{
	public $id = 'register-form';

	public $slid;

	public $maxTriesCount = 5;
	public $maxTriesCountAttribute = 'slid';
	public $triesErrorMessage = 'Registration will be available in {time} seconds.';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
	        ['slid', 'string', 'max' => 255],
        	['slid', 'safe']
        ];
    }

	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'slid' => 'SLID#',
		];
	}
}
