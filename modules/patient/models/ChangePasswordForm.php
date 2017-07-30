<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 15.02.17
 * Time: 10:36
 */

namespace app\modules\patient\models;

use yii\base\Model;

/**
 * Class ChangePasswordForm
 * @package app\modules\patient\models
 */
class ChangePasswordForm extends Model
{
	const SCENARIO_FORGOT = 'forgot';
	/**
	 * @var string
	 */
	public $old_password;
	/**
	 * @var string
	 */
	public $password;
	/**
	 * @var string
	 */
	public $password_repeat;

	private $triesCount;
	private $maxTriesCount = 5;

	public function init() {
		parent::init();
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['old_password', 'password', 'password_repeat'], 'required'],
			['password', 'string', 'min' => 8],
			['password', 'match', 'pattern' => '/^(?=.*[0-9])(.*)$/', 'message' => 'at least one digit required'],
			['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
			[['old_password'], 'checkOldPassword']
		];
	}

	public function scenarios() {
		$scenarios          = parent::scenarios();
		$scenarios[self::SCENARIO_FORGOT] = ['password', 'password_repeat' ];
		return $scenarios;
	}

	public function checkOldPassword($attribute, $params){
		$this->triesCount = (int)\Yii::$app->session->get('change-password-tries-count', 0);
		if ($this->triesCount > $this->maxTriesCount) {
			$this->addError('old_password', 'Too many attempts, please try later.');
		} else {
			if (\Yii::$app->patient->model->generatePasswordHash($this->old_password) != \Yii::$app->patient->password) {
				\Yii::$app->session->set('change-password-tries-count', ++$this->triesCount);
				$this->addError('old_password', 'Wrong password');
			}
		}
	}

	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'old_password' => 'Current password',
			'password' => 'New password',
			'password_repeat' => 'Retype password',
		];
	}

	public function save(){
		if ($this->validate()){
			$model = \Yii::$app->patient->model;
			$model->password = $model->generatePasswordHash($this->password);
			$model->save();
		}
	}
}
