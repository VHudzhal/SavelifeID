<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 15.02.17
 * Time: 10:36
 */

namespace app\modules\patient\models;

use app\components\TimedForm;

/**
 * Class ActivateForm
 * @package app\modules\patient\models
 */
class ActivateForm extends TimedForm
{
	public $id = 'sa_member_edit_form';
	const SCENARIO_REGISTER = 'register';

	public $maxTriesCount = 5;
	public $maxTriesCountAttribute = 'last3hidden';
	public $triesErrorMessage = 'Registration will be available in {time} seconds.';

	/**
	 * @var
	 */
	public $slid;
	/**
	 * @var
	 */
	public $enrollment_code;
	/**
	 * @var
	 */
	public $last3slid;
	/**
	 * @var
	 */
	public $last3hidden;
	/**
	 * @var string
	 */
	public $email;
	/**
	 * @var string
	 */
//	public $zip;
	/**
	 * @var string
	 */
	public $birthyear;
	/**
	 * @var string
	 */
	public $password;
	/**
	 * @var string
	 */
	public $password_repeat;
	/**
	 * @var string
	 */
	public $agree;
	/**
	 * @var integer
	 */
	public $terms_readed;
	/**
	 * @var string
	 */
	public $display_all;
	/**
	 * @var bool
	 */
	public $loaded = false;
	/**
	 * @var Patient
	 */
	public $patient;

	public $complex;

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['slid', 'password', 'password_repeat', 'agree', 'last3slid', 'birthyear'], 'required'],
			['email', 'email'],
			[['birthyear'], 'integer'],
			[['birthyear'], 'app\components\BithyearValidator'],
			[['birthyear'], 'string', 'min' => 2],
			[['birthyear'], 'string', 'max' => 4],
			[['last3slid'], 'string', 'min' => 3],
			[['last3slid'], 'string', 'max' => 3],
			[['last3hidden'], 'string', 'max' => 255],
			[['enrollment_code'], 'required'],
			[['enrollment_code'], 'integer', 'max' => 999999],
			[['enrollment_code'], 'exist', 'targetAttribute' => 'enrollment_code', 'targetClass' => 'app\modules\patient\models\Practices', 'message' => 'The specified partner does not exist.',],
			['password', 'string', 'min' => 8],
			['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
			['agree', 'required', 'requiredValue' => 1, 'message' => 'Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'],
			['terms_readed', 'required', 'requiredValue' => 1, 'message' => 'You have not yet reviewed all of the terms yet. Please read the text until you have scrolled all the way to the bottom before checking your agreement here.'],
			[['last3slid', 'birthyear', 'slid'], 'checkLast2slid'],
			['display_all', 'integer', 'min' => 0, 'max' => 1],
			[['display_all', 'last3hidden'], 'safe']
		];
	}

	public function scenarios() {
		$scenarios          = parent::scenarios();
		$scenarios[self::SCENARIO_DEFAULT]  = [ 'slid', 'last3hidden', 'password', 'password_repeat', 'agree', 'birthyear', 'display_all',  'last3slid', 'terms_readed'];
		$scenarios[self::SCENARIO_REGISTER]  = [ 'slid', 'last3hidden', 'password', 'password_repeat', 'agree', 'birthyear', 'display_all', 'enrollment_code', 'terms_readed' ];
		return $scenarios;
	}

	public function checkLast2slid($attribute, $params){
/*
		if (!$this->last3slid && !$this->birthyear) {
			$this->addError('complex', 'You must provide both your year of birth and the last 3 digits of the id printed on your SaveLifeID card');
		}
*/
		if ($this->scenario == self::SCENARIO_DEFAULT) {
			if (substr($this->patient->internal_id, -3, 3) != $this->last3slid){
				$this->addError('last3slid', 'Incorrect last 3 symbols entered');
			}
		}

//		if ($this->birthyear) {
			/** @var $model Patient */
			if ($this->birthyear != date('Y', strtotime($this->patient->date_of_birth))){
				$this->addError('birthyear', 'Incorrect birth year entered');
			}
//		}
	}

	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'slid' => 'SLID',
			'email' => 'Email',
//			'zip' => 'Zip Code',
			'birthyear' => 'Birth Year',
			'password' => 'New password',
			'password_repeat' => 'Retype password',
			'agree' => 'Agree to the terms of use',
			'last3slid' => 'Last 3 symbols of ID on the card',
			'enrollment_code' => 'Registration code',
			'display_all' => 'DISPLAY ALL my medical information as transmitted by medical practice(s) and/or manually entered on the site, so I won\'t have to enable display of each item individually.',
			'last3hidden' => 'Hidden field for timeout'
		];
	}


	/**
	 * @param $slid
	 */
	public function loadFromSlid($slid){
		if ($slid){
			$this->loaded   = true;
			$model = Patient::find()->where('internal_id_hash = :slid', [':slid' => $slid])->one();
			if ($model){
				$this->slid      = $model->internal_id;
				$this->email     = $model->email;
//				$this->zip       = $this->zip?$this->zip:$model->zip;
				$this->birthyear = (strlen($this->birthyear) == 2)?'19'.$this->birthyear: $this->birthyear;
				$this->patient   = $model;
			} else {
				$this->patient   = false;
			}
		}
	}

	public function load($data, $formName = null){

		$result = parent::load($data, $formName);

		if ($result){
			if ($this->patient) {
				$this->slid      = $this->patient->internal_id;
				$this->email     = $this->patient->email;
			}
			$this->birthyear = (strlen($this->birthyear) == 2)?'19'.$this->birthyear: $this->birthyear;
		}

		return $result;
	}

	public function hiddenSlid(){
		return substr_replace($this->slid,'***',-3);
	}
}
