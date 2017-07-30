<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 14.02.17
 * Time: 14:03
 */

namespace app\modules\patient\components;


use app\components\Cookie;
use app\modules\patient\models\LifeSessions;
use app\modules\patient\models\SlidLookup;
use app\modules\patient\models\TokenActionLookup;
use app\modules\patient\models\TokenActivity;
use app\modules\patient\models\TokenAssociations;
use app\modules\patient\models\TokenTypes;
use yii\base\Component;
use \app\modules\patient\models\Patient as PatientModel;
use yii\base\Security;
use yii\bootstrap\Html;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\HttpException;

/**
 * This is the model class for table "life_patients".
 *
 * @property bool $isGuest
 * @property bool $isActivated
 *
 * @property integer $is_admin
 * @property int $patients_id
 * @property string $internal_id
 * @property int $site_user_id
 * @property int $self_registered
 * @property string $umr_session_id
 * @property string $salt
 * @property string $password
 * @property string $internal_id_hash
 * @property string $status
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_initial
 * @property string $comm_life_token
 * @property string $cell_phone
 * @property string $gender
 * @property string $date_of_birth
 * @property string $picture
 * @property string $billing_name
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $height
 * @property string $height_units
 * @property string $weight
 * @property string $weight_units
 * @property string $date_created
 * @property string $last_updated
 * @property int $partner_id
 * @property int $practice_id
 * @property int $alerts_allowed
 * @property int $notification_updates
 * @property int $notification_scanned
 * @property int $notification_by_email
 * @property int $notification_by_cell
 * @property string $device_dependencies
 * @property string $comments
 * @property string $token
 * @property int $clinical_transaction_received
 * @property string $expiration_date
 * @property string $stripe_customer
 * @property string $stripe_subscription_id
 * @property string $stripe_subscription_type
 * @property int $answer_allergies
 * @property int $answer_conditions
 * @property int $answer_medications
 * @property int $answer_procedures
 * @property int $answer_vaccinations
 * @property int $answer_hospital
 * @property int $answer_physician
 * @property int $answer_emergency_contacts
 * @property int $answer_insurance
 * @property int $answer_advance_directives
 * @property int $answer_ekg
 * @property int $answer_other_documents
 * @property int $answer_device
 * @property int $answer_comments
 * @property int $answer_summary
 * @property int $display_address
 * @property int $display_allergies
 * @property int $display_conditions
 * @property int $display_medical_history
 * @property int $display_medications
 * @property int $display_procedures
 * @property int $display_vaccinations
 * @property int $display_hospital
 * @property int $display_physician
 * @property int $display_emergency_contacts
 * @property int $display_insurance
 * @property int $display_advance_directives
 * @property int $display_ekg
 * @property int $display_other_documents
 * @property int $display_device
 * @property int $display_comments
 * @property int $display_by_default
 * @property string $emr_emergency_summary
 * @property int $display_emr_emergency_summary
 * @property int $answer_emergency_summary
 * @property int $answer_emergency_summary_practice
 * @property int $display_emergency_summary
 * @property string $completed_registration_date
 * @property string $link_exp_date
 */
class Patient extends Component {
	const COOKIE_PARAM = 'slid';
	const AUTH_TIMEOUT = 20*60; // в секундах

	public $isGuest = true;
	public $isActivated = false;
	public $homeUrl = '/';
	public $cookie;

	/**
	 * @var \app\modules\patient\models\Patient
	 */
	public $model;
	/**
	 * @var \app\modules\patient\models\LifeSessions|false
	 */
	public $session;

	public function init(){
		$this->homeUrl = Url::to('/', true);
		$this->cookie = isset(\Yii::$app->request->cookies[self::COOKIE_PARAM])?\Yii::$app->request->cookies[self::COOKIE_PARAM]:null;
		if (\Yii::$app->isDbFree) return;
		if (is_null($this->cookie)) {
			$this->session = false;
		} else {
			$this->session = LifeSessions::find()->where('session_id = :session_id AND (unix_timestamp(now()) - unix_timestamp(last_updated)) < :auth_timeout', [
				':session_id'   => $this->cookie,
				':auth_timeout' => self::AUTH_TIMEOUT
			])->one();
			if ($this->session){
				$this->model = $this->session->patient;
				if ($this->model) {
					$this->setPatientProperties();
					if (!\Yii::$app->request->get('nsp', false)){
						$this->session->last_updated = new Expression('NOW()');
						$this->session->save();
					}
				} else {
					$this->session->delete();
				}
			}
		}

		parent::init();
	}

	public function login($email, $password){
		if (\Yii::$app->isDbFree) return;
		$cookies = \Yii::$app->response->cookies;
		$model = PatientModel::find()->where('email = :email AND password = SHA1(CONCAT(:password, salt))', [':email' => $email, ':password' => $password])->one();
		/** @var $model \app\modules\patient\models\Patient */
		if ($model && (!\Yii::$app->isMaintenance || $model->is_admin)){
			$this->model = $model;
			$this->setPatientProperties();

			// $this->session = LifeSessions::findOne(['patient_id' => $this->model->patients_id]);
			// if (!$this->session) {
				$this->session = new LifeSessions();
				$this->session->patient_id = $this->model->patients_id;
			// }
			$this->session->last_updated = new Expression('NOW()');
			$this->session->session_id = $this->generateSessionID();
			$this->session->save();
      $cookie = new Cookie([
				'name' => self::COOKIE_PARAM,
				'value' => $this->session->session_id,
				'expire' => time()+86400,
         //       'domain' => getenv('COOKIE_DOMAIN')
			]);
      if (getenv('COOKIE_DOMAIN') != 'localhost') {
          $cookie->domain = getenv('COOKIE_DOMAIN');
      }
			$cookies->add($cookie);

			// Delete old sessions
			LifeSessions::deleteAll('(unix_timestamp(now()) - unix_timestamp(last_updated)) > :auth_timeout', [':auth_timeout' => self::AUTH_TIMEOUT]);

			return true;
		} else {
			$this->logout();
			return false;
		}
	}

	public function logout(){
		if ($this->session){ $this->session->delete(); }
		$this->isGuest = true;
		$this->model = null;

    \Yii::$app->response->cookies->remove(new Cookie([
      'name' => self::COOKIE_PARAM,
      'domain' => getenv('COOKIE_DOMAIN')
    ]));

		\Yii::$app->session->removeAll();
		\Yii::$app->getSession()->regenerateID(true);
	}

	public function register(PatientModel $model, $regeneratePassword = true){
		if (\Yii::$app->isDbFree) return null;

		if ($regeneratePassword) {
			$model->salt = $model->getModelSalt();
			$model->password = $model->generatePasswordHash($model->password);
			$model->status   = \app\modules\patient\models\Patient::STATUS_ACTIVE;
		}

		$result = $model->save();
		if (!$result){
			throw new HttpException(500, strip_tags(Html::errorSummary($model)));
		}

		$token = new TokenAssociations();
		$token->token_id = $model->internal_id_hash;
		$token->token_slid = $model->internal_id;
		$token->patient_id = $model->patients_id;
		$token->patient_internal_id = $model->internal_id;
		$token->enrollment = 1;
		$token->active = 1;
		$token->token_type = null;

		$type_name = 'unknown token device';
		$lookup = SlidLookup::findOne(['slid' => $token->token_slid]);
		if ($lookup){
			$token->token_type = $lookup->type;
			$type = TokenTypes::findOne(['token_type' => $lookup->type]);
			if ($type){
				$type_name = $type->text;
			}
		}
		$token->description = "enrollment $type_name";
		if (!$token->save()) {
			throw new HttpException(500, strip_tags(Html::errorSummary($token)));
		}

		$activity = new TokenActivity();
		$activity->patient_id = $model->patients_id;
		$activity->token_id   = $token->token_id;
		$activity->action     = TokenActionLookup::ACTIVATED;
		$activity->activity_date = new Expression('NOW()');
		$activity->save();

		return $result;
	}

	public function redirectToLogin($message = 'Your session has expired'){
		if ($message){
			\Yii::$app->session->addFlash('loginMessage', $message);
		}
		\Yii::$app->guestSession->set('loginUrl', \Yii::$app->request->url);
		\Yii::$app->response->redirect('/login');
		\Yii::$app->end();
	}

	public function getSessionTime(){
		if (\Yii::$app->isDbFree) return 0;
		$seconds = 0;
		if ($this->cookie) {
			$seconds = self::AUTH_TIMEOUT - \Yii::$app->db->createCommand("SELECT unix_timestamp(now()) - unix_timestamp(last_updated) FROM life_sessions WHERE session_id = :session_id", [':session_id' => $this->cookie])->queryScalar();
			$seconds = max($seconds, 0);
		}
		return $seconds;
	}


  private function setPatientProperties(){
	  if (\Yii::$app->isDbFree) return;
	  $this->isGuest = false;
	  $this->isActivated = (bool)$this->model->completed_registration_date;
	  $this->homeUrl = $this->isActivated?Url::to('/subscriber-home', true):Url::to('/', true);
  }










	/**
	 * @inheritdoc
	 */
	public function canGetProperty($name, $checkVars = true, $checkBehaviors = true)
	{
		if (parent::canGetProperty($name, $checkVars, $checkBehaviors)) {
			return true;
		}

		try {
			return $this->model && $this->model->hasAttribute($name);
		} catch (\Exception $e) {
			// `hasAttribute()` may fail on base/abstract classes in case automatic attribute list fetching used
			return false;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function canSetProperty($name, $checkVars = true, $checkBehaviors = true)
	{
		if (parent::canSetProperty($name, $checkVars, $checkBehaviors)) {
			return true;
		}

		try {
			return $this->model->hasAttribute($name);
		} catch (\Exception $e) {
			// `hasAttribute()` may fail on base/abstract classes in case automatic attribute list fetching used
			return false;
		}
	}

	/**
	 * PHP getter magic method.
	 * This method is overridden so that attributes and related objects can be accessed like properties.
	 *
	 * @param string $name property name
	 * @throws \yii\base\InvalidParamException if relation name is wrong
	 * @return mixed property value
	 * @see getAttribute()
	 */
	public function __get($name)
	{
		if ($this->model && $this->model->hasAttribute($name)) {
			return $this->model->getAttribute($name);
		} else {
			return parent::__get($name);
		}
	}

	/**
	 * PHP setter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name, $value)
	{
		if ($this->model && $this->model->hasAttribute($name)) {
			$this->model->setAttribute($name, $value);
		} else {
			parent::__set($name, $value);
		}
	}

	/**
	 * Checks if a property value is null.
	 * This method overrides the parent implementation by checking if the named attribute is `null` or not.
	 * @param string $name the property name or the event name
	 * @return bool whether the property value is null
	 */
	public function __isset($name)
	{
		try {
			return $this->__get($name) !== null;
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * Sets a component property to be null.
	 * This method overrides the parent implementation by clearing
	 * the specified attribute value.
	 * @param string $name the property name or the event name
	 */
	public function __unset($name)
	{
		if ($this->model->hasAttribute($name)) {
			$this->model->setAttribute($name, null);
		} else {
			parent::__unset($name);
		}
	}

	private function generateSessionID(){
		$id = \Yii::$app->security->generateRandomString(20);
		if (LifeSessions::findOne(['session_id' => $id])){
			$id = $this->generateSessionID();
		}
		return $id;
	}
}