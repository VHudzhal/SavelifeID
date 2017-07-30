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
class LoginForm extends TimedForm
{
	public $id = 'login-form';
    public $email;
    public $password;
    public $rememberMe = true;
    public $forgot;

	/**
	 * @var Patient|null
	 */
	public $forgotModel;

	public $maxTriesCount = 5;
	public $maxTriesCountAttribute = 'email';
	public $triesErrorMessage = 'Authorization will be available in {time} seconds.';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            // rememberMe must be a boolean value
            [['rememberMe', 'forgot'], 'boolean'],
            // password is validated by validatePassword()
//            ['email', 'email'],
	        ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
	        [['email'], 'checkTimeout']
        ];
    }

	public function checkTimeout($attribute, $params){
			$this->forgotModel = Patient::findOne(['email' => $this->email]);
			$this->checkTries = true;
			if (!$this->forgotModel) {
				$this->checkTries = false;
				$this->addError('email', 'Incorrect email or password');
				$this->addError('password', 'Incorrect email or password');
			}
	}

	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'email' => 'Email address',
			'password' => 'Password',
			'rememberMe' => 'Remember me',
		];
	}

	/**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
        	if (!$this->forgot) {
		        if (!Yii::$app->patient->login($this->email, $this->password)) {
			        $this->addError('email', 'Incorrect email or password.');
			        $this->addError('password', 'Incorrect email or password.');
		        }
	        }
        }
    }
}
