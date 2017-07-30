<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 15.02.17
 * Time: 10:36
 */

namespace app\modules\patient\models;

use app\components\Helper;
use app\modules\patient\models\Log\EmergencyContactsLog;
use app\modules\patient\models\Log\NotificationsLog;
use app\modules\patient\models\Log\ProfileCategoryVisibilityLog;
use app\modules\patient\models\Log\ProfileItemVisibilityLog;
use Faker\Provider\cs_CZ\DateTime;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class ActivateForm
 * @package app\modules\patient\models
 */
class RecordForm extends Model
{

	const SCENARIO_MAIN               = 'main';
	const SCENARIO_EMERGENCY_PROFILE  = 'emergency-profile';
	const SCENARIO_ALLERGY_PROFILE    = 'allergy-profile';
	const SCENARIO_CONDITIONS_PROFILE = 'conditions-profile';
	const SCENARIO_OTHER_PHYSICIANS   = 'other_physicians';
	const SCENARIO_NOTIFICATIONS      = 'notifications';
	const SCENARIO_MEDICAL_HISTORY    = 'medical-history-profile';
	const SCENARIO_SURGICAL_HISTORY   = 'surgical-history-profile';
	const SCENARIO_MEDICATIONS        = 'medications';
	const SCENARIO_VACCINATIONS       = 'vaccinations';
	const SCENARIO_HOSPITALS          = 'hospitals';
	const SCENARIO_INSURANCE          = 'insurance';
	const SCENARIO_EMERGENCY_CONTACTS = 'emergency-contacts';
	const SCENARIO_EMERGENCY_CONTACTS_VISIBILITY = 'emergency-contacts-visibility';
	const SCENARIO_FILES              = 'files';
	const SCENARIO_EMR_SUMMARY        = 'emr-summary';
	const SCENARIO_DEVICES            = 'devices';
	const SCENARIO_COMMENTS           = 'comments';

	const NOTIFY_WAY_EMAIL = 1;
	const NOTIFY_WAY_PHONE = 2;
	const NOTIFY_WAY_BOTH  = 3;
	/**
	 * @var
	 */
	public $birthday;
	/**
	 * @var
	 */
	public $gender;
	/**
	 * @var integer
	 */
	public $height_feet;
	/**
	 * @var integer
	 */
	public $height_inch;
	/**
	 * @var string
	 */
	public $weight;

	/**
	 * @var integer
	 */
	public $display_all;

	/**
	 * @var integer
	 */
	public $display_emergency_profile_summary;

	/**
	 * @var array
	 */
	public $emergency_profile_items;

	/**
	 * @var array
	 */
	public $emergency_profile_items_ids;

	/**
	 *  @var integer
	 */
	public $display_allergies;

	/**
	 * @var Allergies[]
	 */
	public $allergies_items;
	/**
	 * @var integer[]
	 */
	public $allergies_items_id;


 /**
  * @var integer
  */
 public $display_conditions;

	/**
	 * @var Conditions[]
	 */
 public $conditions_items;

	/**
	 * @var integer[]
	 */
 public $conditions_items_id;


 /**
  * @var integer
  */
 public $display_medical_history;

	/**
	 * @var Conditions[]
	 */
 public $medical_history_items;

	/**
	 * @var integer[]
	 */
 public $medical_history_items_id;

/**
 * @var HistoryText[]
 */
public $medical_history_text_items;
/**
 * @var string
 */
public $medical_history_text;
/**
 * @var integer[]
 */
public $medical_history_text_items_ids;
/**
 * @var HistoryText[]
 */
public $surgical_history_text_items;
/**
 * @var integer[]
 */
public $surgical_history_text_items_ids;


 /**
  * @var integer
  */
 public $display_procedures;

	/**
	 * @var Conditions[]
	 */
 public $surgical_history_items;

	/**
	 * @var integer[]
	 */
 public $surgical_history_items_id;

	/**
	 * @var String
	 */
 public $surgical_history_text;


 /**
  * @var integer
  */
 public $display_medications;

	/**
	 * @var Conditions[]
	 */
 public $medications_items;

	/**
	 * @var integer[]
	 */
 public $medications_items_id;


 /**
  * @var integer
  */
 public $display_vaccinations;

	/**
	 * @var Conditions[]
	 */
 public $vaccinations_items;

	/**
	 * @var integer[]
	 */
 public $vaccinations_items_id;


 /**
  * @var integer
  */
 public $display_hospital;

	/**
	 * @var Conditions[]
	 */
 public $hospitals_items;

	/**
	 * @var integer[]
	 */
 public $hospitals_items_id;


 /**
  * @var integer
  */
 public $display_insurance;

	/**
	 * @var Conditions[]
	 */
 public $insurance_items;

	/**
	 * @var integer[]
	 */
 public $insurance_items_id;

	/**
	 * @var OtherPhysicians[]
	 */
	public $other_physicians_items;
	/**
	 * @var integer[]
	 */
	public $other_physicians_id;
	/**
	 * @var integer
	 */
	public $display_physicians_contact_info;
	/**
	 * @var integer
	 */
	public $notification_updates;
	/**
	 * @var integer
	 */
	public $notification_scanned;
	/**
	 * @var integer
	 */
	public $notify_way;
	/**
	 * @var EmergencyContacts[]
	 */
	public $emergencyContacts;
	/**
	 * @var integer[]
	 */
	public $emergency_contacts_notify_cell;
	/**
	 * @var integer[]
	 */
	public $emergency_contacts_notify_email;
	/**
	 * @var integer[]
	 */
	public $emergency_contacts_notify_display;

	/**
	 * @var integer[]
	 */
	public $file_id;
	/**
	 * @var string
	 */
	public $file_type;
	/**
	 * @var integer
	 */
	public $display_advance_directives;
	/**
	 * @var integer
	 */
	public $display_ekg;
	/**
	 * @var integer
	 */
	public $display_other_documents;
	/**
	 * @var integer
	 */
	public $display_emergency_contacts;

	/**
	 * @var integer
	 */
	public $display_emr_emergency_summary;
	/**
	 * @var string
	 */
    public $emr_emergency_summary;

	/**
	 * @var integer
	 */
	public $display_device;
	/**
	 * @var string
	 */
    public $device_dependencies;
	/**
	 * @var integer
	 */
	public $display_comments;
	/**
	 * @var string
	 */
	public $comments;


	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			['birthday', 'date', 'format' => 'php:m/d/Y'],
			['gender', 'in', 'range' => [Patient::GENDER_MALE, Patient::GENDER_FEMALE]],
			[['height_feet'], 'integer', 'min' => 0, 'max' => 8],
			[['height_inch'], 'integer', 'min' => 0, 'max' => 11],
			[['weight'], 'integer', 'min' => 0, 'max' => 1000],
			[['file_type'], 'in', 'range' => [PatientFiles::TYPE_EKG, PatientFiles::TYPE_ADVANCED_DIRECTIVE, PatientFiles::TYPE_OTHER]],
			[['comments', 'emr_emergency_summary', 'device_dependencies'], 'string'],
			[['display_all',
		'display_emr_emergency_summary',
        'display_emergency_profile_summary',
        'display_allergies',
        'display_conditions',
        'display_medical_history',
        'display_procedures',
        'display_device',
        'display_hospital',
        'display_insurance',
		'display_comments',
        'display_medications',
        'display_vaccinations',
        'display_emergency_contacts',
        'display_physicians_contact_info',
        'notification_scanned',
        'notification_updates', 'display_other_documents', 'display_ekg', 'display_advance_directives'], 'integer', 'min' => 0, 'max' => 1],
			[['notify_way'], 'integer'],
			[['notify_way'], 'in', 'range' => [self::NOTIFY_WAY_EMAIL, self::NOTIFY_WAY_PHONE, self::NOTIFY_WAY_BOTH]],
			[['emergency_profile_items', 'emergency_profile_items_ids',
        'allergies_items', 'allergies_items_id',
        'conditions_items', 'conditions_items_id',
        'medical_history_items', 'medical_history_items_id',
        'medical_history_text_items', 'medical_history_text_items_ids',  'medical_history_text',
        'surgical_history_text_items', 'surgical_history_text_items_ids',  'surgical_history_text',
        'surgical_history_items', 'surgical_history_items_id',
        'medications_items', 'medications_items_id',
        'vaccinations_items', 'vaccinations_items_id',
        'hospitals_items', 'hospitals_items_id',
        'insurance_items', 'insurance_items_id',
        'other_physicians_items', 'other_physicians_id', 'file_id'], 'safe'],
		];
	}

	public function scenarios() {
		$scenarios          = parent::scenarios();
		$scenarios[self::SCENARIO_MAIN]               = [ 'birthday', 'gender', 'height_feet', 'height_inch', 'weight', 'display_all' ];
		$scenarios[self::SCENARIO_EMERGENCY_PROFILE]  = [ 'display_emergency_profile_summary', 'emergency_profile_items', 'emergency_profile_items_ids'];
		$scenarios[self::SCENARIO_ALLERGY_PROFILE]    = [ 'display_allergies', 'allergies_items', 'allergies_items_id'];
		$scenarios[self::SCENARIO_CONDITIONS_PROFILE] = [ 'display_conditions', 'conditions_items', 'conditions_items_id'];
		$scenarios[self::SCENARIO_MEDICAL_HISTORY]    = [ 'display_medical_history', 'medical_history_items', 'medical_history_items_id', 'medical_history_text_items', 'medical_history_text_items_ids'];
		$scenarios[self::SCENARIO_SURGICAL_HISTORY]   = [ 'display_procedures', 'surgical_history_items', 'surgical_history_items_id', 'surgical_history_text', 'surgical_history_text_items', 'surgical_history_text_items_ids' ];
	    $scenarios[self::SCENARIO_MEDICATIONS]        = [ 'display_medications', 'medications_items', 'medications_items_id' ];
	    $scenarios[self::SCENARIO_VACCINATIONS]       = [ 'display_vaccinations', 'vaccinations_items', 'vaccinations_items_id'];
	    $scenarios[self::SCENARIO_HOSPITALS]          = [ 'display_hospital', 'hospitals_items', 'hospitals_items_id'];
	    $scenarios[self::SCENARIO_INSURANCE]          = [ 'display_insurance', 'insurance_items', 'insurance_items_id'];
		$scenarios[self::SCENARIO_OTHER_PHYSICIANS]   = [ 'display_physicians_contact_info', 'other_physicians_items', 'other_physicians_id'];
		$scenarios[self::SCENARIO_NOTIFICATIONS]      = [ 'notification_scanned', 'notification_updates', 'notify_way'];
		$scenarios[self::SCENARIO_EMERGENCY_CONTACTS] = [ 'emergency_contacts_notify_cell', 'emergency_contacts_notify_email', 'emergency_contacts_notify_display'];
		$scenarios[self::SCENARIO_EMERGENCY_CONTACTS_VISIBILITY] = [ 'display_emergency_contacts'];
		$scenarios[self::SCENARIO_FILES]              = [ 'file_id', 'file_type', 'display_other_documents', 'display_ekg', 'display_advance_directives'];
		$scenarios[self::SCENARIO_EMR_SUMMARY]        = [ 'display_emr_emergency_summary', 'emr_emergency_summary'];
		$scenarios[self::SCENARIO_DEVICES]            = [ 'display_device', 'device_dependencies'];
		$scenarios[self::SCENARIO_COMMENTS]           = [ 'display_comments', 'comments'];
		return $scenarios;
	}


	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'birthday' => 'Date of Birth',
			'gender' => 'Gender',
			'height_feet' => 'Height, feet',
			'height_inch' => 'Height, inch',
			'weight' => 'Weight',
			'display_all' => 'DISPLAY ALL my medical information as transmitted by medical practice(s) and/or manually entered on the site, so I won\'t have to enable display of each item individually.',
			'display_emergency_profile_summary' => 'I want to add an emergency profile summary',
			'display_allergies' => 'Known Allergies',
			'display_conditions' => 'Medical Conditions',
			'display_medical_history' => 'Medical History',
			'display_procedures' => 'Surgical History',
			'display_medications' => 'Medications',
			'display_vaccinations' => 'Vaccinations',
			'display_hospital' => 'Hospitals',
			'display_insurance' => 'Insurance',
			'display_physicians_contact_info' => 'Physicians Contact Info',
			'notification_scanned' => 'Whenever my card is scanned',
			'notification_updates' => 'Whenever my medical info is changed',
			'display_advance_directives' => 'Advanced Directives',
			'display_ekg' => 'EKG',
			'display_other_documents' => 'Medical Images/Records',
			'display_emergency_contacts' => 'Emergency Contacts',
			'display_emr_emergency_summary' => 'EMR Emergency Summary',
			'display_device' => 'Device Dependencies',
			'display_comments' => 'Comments',
		];
	}

	public function init(){
		parent::init();
		$model = \Yii::$app->patient->model;

		if ($scenario = \Yii::$app->request->post('form_scenario', false)){
			$this->scenario = $scenario;
		}

		$birthday = \DateTime::createFromFormat('Y-m-d', $model->date_of_birth);
		$errors = \DateTime::getLastErrors();
		if (!empty($errors['warning_count'])) {
			$date = null;
		} else {
			$date = $birthday->format('m/d/Y');
		}

		$this->birthday    = $date;
		$this->gender      = $model->gender;

		$height            = $model->divideHeightToFeetAndInchs();
		$this->height_feet = $height['feet'];
		$this->height_inch = $height['inches'];

		$this->gender      = $model->gender;
		$this->weight      = $model->getWeightInPouds();

		$this->display_all = ($model->display_by_default == 1)?1:0;
		$this->display_emergency_profile_summary = ($model->display_emergency_summary == 1)?1:0;

		$this->display_allergies = $model->display_allergies?1:0;
	    $this->display_conditions = $model->display_conditions?1:0;
	    $this->display_medications = $model->display_medications?1:0;
	    $this->display_vaccinations = $model->display_vaccinations?1:0;
	    $this->display_hospital = $model->display_hospital?1:0;
	    $this->display_insurance = $model->display_insurance?1:0;
	    $this->display_medical_history = $model->display_medical_history?1:0;
	    $this->display_procedures = $model->display_procedures?1:0;
		$this->display_physicians_contact_info = $model->display_physician?1:0;
		$this->display_advance_directives = $model->display_advance_directives?1:0;
		$this->display_ekg = $model->display_ekg?1:0;
		$this->display_other_documents = $model->display_other_documents?1:0;
		$this->display_emergency_contacts = $model->display_emergency_contacts?1:0;
		$this->display_emr_emergency_summary = $model->display_emr_emergency_summary?1:0;
		$this->display_device = $model->display_device?1:0;
		$this->display_comments = $model->display_comments?1:0;

		$this->initEmergencyProfileItems();
		$this->allergies_items = $model->allergies;
	    $this->conditions_items = $model->conditions;
	    $this->medications_items = $model->medications;
	    $this->vaccinations_items = $model->vaccinations;
	    $this->hospitals_items = $model->hospitals;
	    $this->insurance_items = $model->insurance;
	    $this->medical_history_items = $model->medicalHistory;
	    $this->medical_history_text_items = $model->medicalHistoryTexts;
		$this->surgical_history_items = $model->surgicalHistory;
		$this->surgical_history_text_items = $model->surgicalHistoryTexts;
		$this->other_physicians_items = $model->otherPhysicians;
		$this->emergencyContacts = $model->emergencyContacts;
		$this->emr_emergency_summary = $model->emr_emergency_summary;
		$this->device_dependencies = $model->device_dependencies;
		$this->comments    = $model->comments;

		$this->notification_scanned = $model->notification_scanned;
		$this->notification_updates = $model->notification_updates;

		$this->notify_way   = 0;
		$this->notify_way   = $model->notification_by_email                                 ? self::NOTIFY_WAY_EMAIL : $this->notify_way;
		$this->notify_way   = $model->notification_by_cell                                  ? self::NOTIFY_WAY_PHONE : $this->notify_way;
		$this->notify_way   = $model->notification_by_email && $model->notification_by_cell ? self::NOTIFY_WAY_BOTH  : $this->notify_way;
	}

	public function load( $data, $formName = null ) {
		$result =  parent::load( $data, $formName );

		$this->loadEmergencyProfileItems();

		return $result;
	}

	public function save($runValidation = true){
		if ($runValidation){
			if (!$this->validate()) return false;
		}

		$model = \Yii::$app->patient->model;
		$oldPatientAttributes = $model->getAttributes();

		switch($this->scenario) {
			case self::SCENARIO_MAIN:
				$date = \DateTime::createFromFormat('m/d/Y', $this->birthday);
				if ($date){
					$errors = \DateTime::getLastErrors();
					if (empty($errors['warning_count'])) {
						$model->date_of_birth = $date->format('Y-m-d');
					}
				}

				$model->gender        = $this->gender;
				$model->weight        = $this->weight;
				$model->weight_units  = Patient::WEIGHT_IN_POUDS;
				$model->height        = 12 * (int)$this->height_feet + (int)$this->height_inch;
				$model->height_units  = Patient::HEIGHT_IN_INCHES;
				$model->display_by_default = $this->display_all ? 1 : 0;
				break;
			case self::SCENARIO_EMERGENCY_PROFILE:
				$model->display_emergency_summary = $this->display_emergency_profile_summary ? 1 : 0;
				$oldData = EmergencyProfileSummary::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				EmergencyProfileSummary::deleteAll(['internal_id' => \Yii::$app->patient->internal_id]);
				foreach ($this->emergency_profile_items as $item){
					if ($item['checked']) {
						$profile = new EmergencyProfileSummary();
						$profile->internal_id    = \Yii::$app->patient->internal_id;
						$profile->emergency_item = $item['name'];
						$profile->life_emergency_profile_summary_lookup_id = $item['custom']?0:$item['value'];
						$profile->save();
					}
				}
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => EmergencyProfileSummary::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'I want to add an emergency profile summary'
				]))->save();
				break;
			case self::SCENARIO_ALLERGY_PROFILE:
				$model->display_allergies = $this->display_allergies ? 1 : 0;
				$oldData = Allergies::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				Allergies::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				Allergies::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'allergy_id' => $this->allergies_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => Allergies::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Known Allergies'
				]))->save();
				break;
			case self::SCENARIO_CONDITIONS_PROFILE:
				$model->display_conditions = $this->display_conditions ? 1 : 0;
				$oldData = Conditions::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				Conditions::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				Conditions::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'problem_id' => $this->conditions_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => Conditions::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Medical Conditions'
				]))->save();
				break;
			case self::SCENARIO_MEDICATIONS:
				$model->display_medications = $this->display_medications ? 1 : 0;
				$oldData = Medications::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				Medications::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				Medications::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'life_medication_id' => $this->medications_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => Medications::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Medications'
				]))->save();
				break;
			case self::SCENARIO_VACCINATIONS:
				$model->display_vaccinations = $this->display_vaccinations ? 1 : 0;
				$oldData = Vaccinations::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				Vaccinations::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				Vaccinations::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'vaccination_id' => $this->vaccinations_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => Vaccinations::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Vaccinations'
				]))->save();
				break;
			case self::SCENARIO_HOSPITALS:
				$model->display_hospital = $this->display_hospital ? 1 : 0;
				$oldData = Hospitals::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				Hospitals::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				Hospitals::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'hospital_id' => $this->hospitals_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => Hospitals::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Hospitals'
				]))->save();
				break;
			case self::SCENARIO_INSURANCE:
				$model->display_insurance = $this->display_insurance ? 1 : 0;
				$oldData = Insurance::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				Insurance::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				Insurance::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'life_insurance_id' => $this->insurance_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => Insurance::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Insurance'
				]))->save();
				break;
			case self::SCENARIO_MEDICAL_HISTORY:
				$model->display_medical_history = $this->display_medical_history ? 1 : 0;
				$oldData = MedicalHistory::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				MedicalHistory::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				MedicalHistory::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'medical_history_id' => $this->medical_history_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => MedicalHistory::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Medical History'
				]))->save();
				$oldData = HistoryText::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_MEDICAL]);
				HistoryText::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_MEDICAL]);
				HistoryText::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_MEDICAL, 'text_id' => $this->medical_history_text_items_ids]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => HistoryText::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_MEDICAL]),
					'category' => 'Medical History Text'
				]))->save();
				break;
			case self::SCENARIO_SURGICAL_HISTORY:
				$model->display_procedures = $this->display_procedures ? 1 : 0;
				$oldData = SurgicalHistory::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
				SurgicalHistory::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				SurgicalHistory::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'life_surgical_history_id' => $this->surgical_history_items_id]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => SurgicalHistory::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'category' => 'Surgical History'
				]))->save();
				$oldData = HistoryText::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_SURGICAL]);
				HistoryText::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_SURGICAL]);
				HistoryText::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_SURGICAL, 'text_id' => $this->surgical_history_text_items_ids]);
				(new ProfileItemVisibilityLog([
					'old' => $oldData,
					'new' => HistoryText::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'type' => HistoryText::TYPE_SURGICAL]),
					'category' => 'Surgical History Text'
				]))->save();
				break;
			case self::SCENARIO_OTHER_PHYSICIANS:
				$model->display_physician = $this->display_physicians_contact_info ? 1 : 0;
				if ($this->other_physicians_id){
					$oldData = OtherPhysicians::findAll(['internal_id' => \Yii::$app->patient->internal_id]);
					OtherPhysicians::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
					OtherPhysicians::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'physician_id' => $this->other_physicians_id]);
					(new ProfileItemVisibilityLog([
						'old' => $oldData,
						'new' => OtherPhysicians::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
						'category' => 'Physicians Contact Info'
					]))->save();
				}
				break;
			case self::SCENARIO_NOTIFICATIONS:
				$old = $model->getAttributes();
				$model->notification_scanned  = $this->notification_scanned?1:0;
				$model->notification_updates  = $this->notification_updates?1:0;
				$model->notification_by_cell  = in_array($this->notify_way, [self::NOTIFY_WAY_PHONE, self::NOTIFY_WAY_BOTH]) ? 1 : 0;
				$model->notification_by_email = in_array($this->notify_way, [self::NOTIFY_WAY_EMAIL, self::NOTIFY_WAY_BOTH]) ? 1 : 0;
				(new NotificationsLog(['old' => $old, 'new' => $model->getAttributes()]))->save();
				break;
			case self::SCENARIO_EMERGENCY_CONTACTS_VISIBILITY:
				$model->display_emergency_contacts = $this->display_emergency_contacts?1:0;
				break;
			case self::SCENARIO_EMERGENCY_CONTACTS:
				$log_data = [
					'source'       => EmergencyContacts::findAll(['internal_id' => \Yii::$app->patient->internal_id]),
					'display'      => EmergencyContacts::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $this->emergency_contacts_notify_display]),
					'notify_cell'  => EmergencyContacts::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $this->emergency_contacts_notify_cell]),
					'notify_email' => EmergencyContacts::findAll(['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $this->emergency_contacts_notify_email])
				];
				EmergencyContacts::updateAll(['display' => 0, 'notify_email' => 0, 'notify_cell' => 0], ['internal_id' => \Yii::$app->patient->internal_id]);
				EmergencyContacts::updateAll(['display' => 1],      ['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $this->emergency_contacts_notify_display]);
				EmergencyContacts::updateAll(['notify_cell' => 1],  ['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $this->emergency_contacts_notify_cell]);
				EmergencyContacts::updateAll(['notify_email' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'contact_id' => $this->emergency_contacts_notify_email]);

				$model->display_emergency_contacts = $this->display_emergency_contacts?1:0;

				$log_data = EmergencyContactsLog::explodeData($log_data);
				foreach($log_data as $log){
					(new EmergencyContactsLog($log))->save();
				}

				break;
			case self::SCENARIO_FILES:
				PatientFiles::updateAll(['display' => 0], ['internal_id' => \Yii::$app->patient->internal_id, 'file_type' => $this->file_type]);
				PatientFiles::updateAll(['display' => 1], ['internal_id' => \Yii::$app->patient->internal_id, 'file_type' => $this->file_type, 'patient_files_id' => $this->file_id]);
				$model->display_advance_directives = $this->display_advance_directives?1:0;
				$model->display_ekg = $this->display_ekg?1:0;
				$model->display_other_documents = $this->display_other_documents?1:0;
				break;
			case self::SCENARIO_EMR_SUMMARY:
				$model->display_emr_emergency_summary = $this->display_emr_emergency_summary ? 1 : 0;
				break;
			case self::SCENARIO_DEVICES:
				$model->display_device = $this->display_device ? 1 : 0;
				break;
			case self::SCENARIO_COMMENTS:
				$model->display_comments = $this->display_comments ? 1 : 0;
				break;


		}

		(new ProfileCategoryVisibilityLog(['old' => $oldPatientAttributes, 'new' => $model->getAttributes()]))->save();

		return $model->save($runValidation);
	}


	private function initEmergencyProfileItems(){
		$this->emergency_profile_items = [];
		// Add standart emergency profile items
		foreach(EmergencyProfileSummaryLookup::find()->orderBy(['life_emergency_profile_summary_lookup_item' => SORT_ASC])->all() as $one){
			/**
			 * @var $one EmergencyProfileSummaryLookup
			 */
			$profileModel = EmergencyProfileSummary::findOne([
				'life_emergency_profile_summary_lookup_id' => $one->life_emergency_profile_summary_lookup_id,
				'internal_id'                              => \Yii::$app->patient->internal_id
			]);

			$this->emergency_profile_items['si_'.$one->life_emergency_profile_summary_lookup_id] = [
				'value'   => $one->life_emergency_profile_summary_lookup_id,
				'name'    => $one->life_emergency_profile_summary_lookup_item,
				'checked' => (bool) $profileModel,
				'id'      => $profileModel?$profileModel->id:null,
				'custom'  => false,
			];
		}

		// Add custom emergency profile items
		foreach(EmergencyProfileSummary::find()->where(['internal_id' => \Yii::$app->patient->internal_id, 'life_emergency_profile_summary_lookup_id' => 0])->orderBy(['emergency_item' => SORT_ASC])->all() as $one){
			/**
			 * @var $one EmergencyProfileSummary
			 */
			$this->emergency_profile_items['ci_'.$one->emergency_item] = [
				'value'   => $one->emergency_item,
				'name'    => $one->emergency_item,
				'checked' => true,
				'id'      => $one->id,
				'custom'  => true,
			];
		}
	}

	private function loadEmergencyProfileItems(){
		$items = $this->emergency_profile_items_ids;

		if (is_array($this->emergency_profile_items_ids ) ) {
			$this->initEmergencyProfileItems();
			foreach ( $this->emergency_profile_items as $key => $item ) {
				$this->emergency_profile_items[ $key ]['checked'] = false;
			}
			foreach ( $items as $item ) {
				if ( is_numeric( $item ) ) {
					if ( $item > 0 ) {
						$this->emergency_profile_items[ 'si_' . $item ]['checked'] = true;
					}
				} else {
					if ( ! isset( $this->emergency_profile_items[ 'ci_' . $item ] ) ) {
						$this->emergency_profile_items[ 'ci_' . $item ] = [
							'value'   => $item,
							'name'    => $item,
							'checked' => true,
							'id'      => null,
							'custom'  => true,
						];
					}
					$this->emergency_profile_items[ 'ci_' . $item ]['checked'] = true;
				}
			}
		}
	}
}
