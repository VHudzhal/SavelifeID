<?php

namespace app\modules\patient\models;

use app\components\Helper;
use app\modules\patient\models\Log\PasswordChangeLog;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "life_patients".
 *
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
 * @property boolean $is_admin
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
 * @property int $support_request
 * @property string $emr_emergency_summary
 * @property int $display_emr_emergency_summary
 * @property int $answer_emergency_summary
 * @property int $answer_emergency_summary_practice
 * @property int $display_emergency_summary
 * @property string $completed_registration_date
 * @property string $link_exp_date
 *
 * @property Allergies[] $allergies
 * @property Conditions[] $conditions
 * @property MedicalHistory[] $medicalHistory
 * @property HistoryText[] $medicalHistoryTexts
 * @property HistoryText[] $surgicalHistoryTexts
 * @property SurgicalHistory[] $surgicalHistory
 * @property OtherPhysicians[] $otherPhysicians
 * @property Medications[] $medications
 * @property Vaccinations[] $vaccinations
 * @property Hospitals[] $hospitals
 * @property Insurance[] $insurance
 * @property EmergencyContacts[] $emergencyContacts
 * @property PatientFiles[] $files
 * @property PatientFiles[] $filesEKG
 * @property PatientFiles[] $filesAdvancedDirective
 * @property PatientFiles[] $filesOther
 * @property TokenAssociations[] $tokens
 * @property Problems[] $problems
 */
class Patient extends \yii\db\ActiveRecord
{
	const HEIGHT_IN_INCHES = 'inches';

	const GENDER_MALE = 'Male';
	const GENDER_FEMALE = 'Female';

	const WEIGHT_IN_POUDS = 'pounds';

	const STATUS_ACTIVE = 'active';
	const STATUS_PAUSED = 'paused';
	const STATUS_CANCEL = 'cancel';

	const PROTOCOL_S3 = 's3';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_patients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id'], 'required'],
            [['internal_id_hash'], 'required', 'message' => "Incorrect patient`s data"],
            [['site_user_id', 'self_registered', 'partner_id', 'practice_id', 'alerts_allowed', 'notification_updates', 'notification_scanned', 'notification_by_email', 'notification_by_cell', 'clinical_transaction_received', 'answer_allergies', 'answer_conditions', 'answer_medications', 'answer_procedures', 'answer_vaccinations', 'answer_hospital', 'answer_physician', 'answer_emergency_contacts', 'answer_insurance', 'answer_advance_directives', 'answer_ekg', 'answer_other_documents', 'answer_device', 'answer_comments', 'answer_summary', 'display_address', 'display_allergies', 'display_conditions', 'display_medications', 'display_procedures', 'display_vaccinations', 'display_hospital', 'display_physician', 'display_emergency_contacts', 'display_insurance', 'display_advance_directives', 'display_ekg', 'display_other_documents', 'display_device', 'display_comments', 'display_by_default', 'display_emr_emergency_summary', 'answer_emergency_summary', 'answer_emergency_summary_practice', 'display_emergency_summary', 'display_medical_history', 'height', 'weight', 'is_admin', 'support_request'], 'integer'],
            [['date_of_birth', 'date_created', 'last_updated', 'expiration_date', 'completed_registration_date', 'link_exp_date'], 'safe'],
            [['device_dependencies', 'comments'], 'string'],
            [['internal_id', 'status', 'city', 'state', 'stripe_customer', 'stripe_subscription_id', 'stripe_subscription_type'], 'string', 'max' => 50],
	        ['internal_id', 'unique', 'targetAttribute' => ['internal_id'], 'message' => 'Already exists patient with this internal ID.'],

	        [['umr_session_id', 'email', 'picture', 'billing_name', 'token'], 'string', 'max' => 100],
            [['salt'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 40],
            [['internal_id_hash', 'first_name', 'last_name', 'address_1', 'address_2'], 'string', 'max' => 255],
            [['middle_initial', 'comm_life_token', 'gender'], 'string', 'max' => 10],
            [['cell_phone', 'zip'], 'string', 'max' => 20],
            [['cell_phone'], 'default', 'value' => ''],
	        [['height_units'], 'in', 'range' => [self::HEIGHT_IN_INCHES]],
	        [['weight_units'], 'in', 'range' => [self::WEIGHT_IN_POUDS]],
            [['emr_emergency_summary'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patients_id' => 'Patient ID',
            'internal_id' => 'Internal ID',
            'site_user_id' => 'Site User ID',
            'self_registered' => 'Self Registered',
            'umr_session_id' => 'Umr Session ID',
            'salt' => 'Salt',
            'password' => 'Password',
            'internal_id_hash' => 'Internal Id Hash',
            'status' => 'Status',
            'email' => 'E-mail',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_initial' => 'MI',
            'comm_life_token' => 'Comm Life Token',
            'cell_phone' => 'Mobile Phone',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'picture' => 'Picture',
            'billing_name' => 'Billing Name',
            'address_1' => 'Address',
            'address_2' => 'Address 2',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'height' => 'Height',
            'height_units' => 'Height Units',
            'weight' => 'Weight',
            'weight_units' => 'Weight Units',
            'date_created' => 'Date Created',
            'last_updated' => 'Last Updated',
            'partner_id' => 'Partner ID',
            'practice_id' => 'Practice ID',
            'alerts_allowed' => 'Alerts Allowed',
            'notification_updates' => 'Notification Updates',
            'notification_scanned' => 'Notification Scanned',
            'notification_by_email' => 'Notification By Email',
            'notification_by_cell' => 'Notification By Cell',
            'device_dependencies' => 'Device Dependencies',
            'comments' => 'Comments',
            'token' => 'Token',
            'clinical_transaction_received' => 'Clinical Transaction Received',
            'expiration_date' => 'Expiration Date',
            'stripe_customer' => 'Stripe Customer',
            'stripe_subscription_id' => 'Stripe Subscription ID',
            'stripe_subscription_type' => 'Stripe Subscription Type',
            'answer_allergies' => 'Answer Allergies',
            'answer_conditions' => 'Answer Conditions',
            'answer_medications' => 'Answer Medications',
            'answer_procedures' => 'Answer Procedures',
            'answer_vaccinations' => 'Answer Vaccinations',
            'answer_hospital' => 'Answer Hospital',
            'answer_physician' => 'Answer Physician',
            'answer_emergency_contacts' => 'Answer Emergency Contacts',
            'answer_insurance' => 'Answer Insurance',
            'answer_advance_directives' => 'Answer Advance Directives',
            'answer_ekg' => 'Answer Ekg',
            'answer_other_documents' => 'Answer Other Documents',
            'answer_device' => 'Answer Device',
            'answer_comments' => 'Answer Comments',
            'answer_summary' => 'Answer Summary',
            'display_address' => 'Display address on my profile',
            'display_allergies' => 'Display Allergies',
            'display_conditions' => 'Display Conditions',
            'display_medications' => 'Display Medications',
            'display_procedures' => 'Display Procedures',
            'display_vaccinations' => 'Display Vaccinations',
            'display_hospital' => 'Display Hospital',
            'display_medical_history' => 'Display Medical History',
            'display_physician' => 'Display Physician',
            'display_emergency_contacts' => 'Display Emergency Contacts',
            'display_insurance' => 'Display Insurance',
            'display_advance_directives' => 'Display Advance Directives',
            'display_ekg' => 'Display Ekg',
            'display_other_documents' => 'Display Other Documents',
            'display_device' => 'Display Device',
            'display_comments' => 'Display Comments',
            'display_by_default' => 'Display By Default',
            'emr_emergency_summary' => 'Emr Emergency Summary',
            'display_emr_emergency_summary' => 'Display Emr Emergency Summary',
            'answer_emergency_summary' => 'Answer Emergency Summary',
            'answer_emergency_summary_practice' => 'Answer Emergency Summary Practice',
            'display_emergency_summary' => 'Display Emergency Summary',
            'completed_registration_date' => 'Completed registration date',
            'link_exp_date' => 'Reset Password Link Expiration Date',
            'is_admin' => 'Is administrator',
            'support_request' => 'Support Request',
        ];
    }

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'date_created',
				'updatedAtAttribute' => 'last_updated',
				'value' => function ($event)
				{
					$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
					return $date_utc->format(\DateTime::W3C);
				},
			],
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAllergies(){
    	return $this->hasMany(Allergies::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getConditions(){
    	return $this->hasMany(Conditions::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMedicalHistory(){
    	return $this->hasMany(MedicalHistory::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMedicalHistoryTexts(){
		return $this->hasMany(HistoryText::className(), ['internal_id' => 'internal_id' ])->andOnCondition(['type' => HistoryText::TYPE_MEDICAL])->orderBy(['life_history_texts.practice_id'=>SORT_ASC, 'life_history_texts.text_id' => SORT_ASC]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSurgicalHistoryTexts(){
		return $this->hasMany(HistoryText::className(), ['internal_id' => 'internal_id' ])->andOnCondition(['type' => HistoryText::TYPE_SURGICAL])->orderBy(['life_history_texts.practice_id'=>SORT_ASC, 'life_history_texts.text_id' => SORT_ASC]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSurgicalHistory(){
    	return $this->hasMany(SurgicalHistory::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getVaccinations(){
    	return $this->hasMany(Vaccinations::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProblems(){
    	return $this->hasMany(Problems::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMedications(){
    	return $this->hasMany(Medications::className(), ['internal_id' => 'internal_id' ]);
	}


	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getHospitals(){
    	return $this->hasMany(Hospitals::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSurgical_history(){
    	return $this->hasMany(SurgicalHistory::className(), ['internal_id' => 'internal_id' ]);
	}


	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getInsurance(){
    	return $this->hasMany(Insurance::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOtherPhysicians(){
    	return $this->hasMany(OtherPhysicians::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEmergencyContacts(){
    	return $this->hasMany(EmergencyContacts::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFiles(){
    	return $this->hasMany(PatientFiles::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMedical_history(){
    	return $this->hasMany(MedicalHistory::className(), ['internal_id' => 'internal_id' ]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFilesEKG(){
    	return $this->hasMany(PatientFiles::className(), ['internal_id' => 'internal_id' ])->andOnCondition(['file_type' => PatientFiles::TYPE_EKG]);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFilesAdvancedDirective(){
    	return $this->hasMany(PatientFiles::className(), ['internal_id' => 'internal_id' ])->andOnCondition(['file_type' => PatientFiles::TYPE_ADVANCED_DIRECTIVE]);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFilesOther(){
    	return $this->hasMany(PatientFiles::className(), ['internal_id' => 'internal_id' ])->andOnCondition(['file_type' => PatientFiles::TYPE_OTHER]);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTokens(){
    	return $this->hasMany(TokenAssociations::className(), ['patient_id' => 'patients_id' ])->orderBy(['active' => SORT_ASC]);
	}

    public function getModelSalt(){
    	return $this->salt?$this->salt:Yii::$app->getSecurity()->generateRandomString();
    }

    public function setModelSalt(){
    	$this->salt = Yii::$app->getSecurity()->generateRandomString();
    }

    public function generatePasswordHash($password){
    	return sha1($password . $this->getModelSalt());
    }

    public function isDisplayChildrens($childName, $currentState){
    	if ($currentState) {
		    foreach ($this->$childName as $one){
			    $currentState &= $one->display;
		    }
	    }
	    return $currentState;
    }

    public function isDisplayAll(){
	    $displayAll = 1;
	    $displayAll &= $this->display_address;
	    $displayAll &= $this->display_allergies;
	    $displayAll &= $this->display_conditions;
	    $displayAll &= $this->display_medications;
	    $displayAll &= $this->display_medical_history;
	    $displayAll &= $this->display_procedures;
	    $displayAll &= $this->display_vaccinations;
	    $displayAll &= $this->display_hospital;
	    $displayAll &= $this->display_physician;
	    $displayAll &= $this->display_emergency_contacts;
	    $displayAll &= $this->display_insurance;
	    $displayAll &= $this->display_advance_directives;
	    $displayAll &= $this->display_ekg;
	    $displayAll &= $this->display_other_documents;
	    $displayAll &= $this->display_device;
	    $displayAll &= $this->display_comments;
	    $displayAll &= $this->display_emr_emergency_summary;
	    $displayAll &= $this->display_emergency_summary;

	    $displayAll &= $this->isDisplayChildrens('allergies', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('emergencyContacts', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('insurance', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('medical_history', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('medications', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('otherPhysicians', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('files', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('hospitals', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('problems', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('surgical_history', $displayAll);
	    $displayAll &= $this->isDisplayChildrens('vaccinations', $displayAll);

	    return $displayAll;
    }
    
    public function beforeSave( $insert ) {
	    if ($this->display_by_default){

	    	$changed = true;
		    if (!$insert) {
			    $old     = Patient::findOne( [ 'patients_id' => $this->patients_id ] );
			    $changes = Helper::array_diff_assoc_recursive( $old, $this );
			    if (!isset($changes['display_by_default'])){
				    $changed = false;
			    }
		    }

		    if ($changed) {
			    $this->display_address = 1;
			    $this->display_allergies = 1;
			    $this->display_conditions = 1;
			    $this->display_medications = 1;
			    $this->display_medical_history = 1;
			    $this->display_procedures = 1;
			    $this->display_vaccinations = 1;
			    $this->display_hospital = 1;
			    $this->display_physician = 1;
			    $this->display_emergency_contacts = 1;
			    $this->display_insurance = 1;
			    $this->display_advance_directives = 1;
			    $this->display_ekg = 1;
			    $this->display_other_documents = 1;
			    $this->display_device = 1;
			    $this->display_comments = 1;
			    $this->display_emr_emergency_summary = 1;
			    $this->display_emergency_summary = 1;
			    foreach ($this->allergies as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->emergencyContacts as $one){
				    $one->display = 1;
				    if (!$one->save(false)) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->insurance as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->medical_history as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->medications as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->otherPhysicians as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->files as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->hospitals as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->problems as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->surgical_history as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
			    foreach ($this->vaccinations as $one){
				    $one->display = 1;
				    if (!$one->save()) throw new \yii\db\Exception(strip_tags(Html::errorSummary($one)));
			    }
		    }
	    }

	    if ($this->isDisplayAll()){
		    $this->display_by_default = 1;
	    } else {
		    $this->display_by_default = 0;
	    }
    	
    	if (!$insert){
    		$old = Patient::findOne(['patients_id' => $this->patients_id]);

    		$changes = Helper::array_diff_assoc_recursive($old, $this);

		    unset($changes['last_updated']);

    		if ($changes){
			    $model = new PatientLog();
			    $data = $this->attributes();
			    unset($data['patients_id']);
			    $model->setAttributes($data);
			    if (!$model->save(false)) {
			    	var_dump($model->errors); die();
			    }

			    if ($old->picture !== $this->picture){
			    	// add old to remove list if has protocol
				    $old_key = Helper::getS3BucketRoot().\Yii::$app->patient->internal_id.'/picture/'.$old->picture;
				    AssetDeletionQueue::add( 's3://'.getenv('BUCKET_IMAGE').'/'.$old_key );

				    $key = Helper::getS3BucketRoot().\Yii::$app->patient->internal_id.'/picture/'.$this->picture;
			    	AssetDeletionQueue::deleteAll(['s3url' => 's3://'.getenv('BUCKET_IMAGE').'/'.$key]);
			    }

			    if ($old->password != $this->password) {
				    (new PasswordChangeLog(['current_patient' => $this]))->save();
			    }
		    }
	    }
	    return parent::beforeSave( $insert );
    }

    public function beforeDelete() {
	    Allergies::deleteAll(['internal_id' => $this->internal_id]);
	    EmergencyContacts::deleteAll(['internal_id' => $this->internal_id]);
	    EmergencyProfileSummary::deleteAll(['internal_id' => $this->internal_id]);
	    Insurance::deleteAll(['internal_id' => $this->internal_id]);
	    Log::deleteAll(['patients_id' => $this->patients_id]);
	    MedicalHistory::deleteAll(['internal_id' => $this->internal_id]);
	    Medications::deleteAll(['internal_id' => $this->internal_id]);
	    Notifications::deleteAll(['internal_id' => $this->internal_id]);
	    OtherPhysicians::deleteAll(['internal_id' => $this->internal_id]);
	    PatientFiles::deleteAll(['internal_id' => $this->internal_id]);
	    PatientLog::deleteAll(['internal_id' => $this->internal_id]);
	    Hospitals::deleteAll(['internal_id' => $this->internal_id]);
	    Problems::deleteAll(['internal_id' => $this->internal_id]);
	    SourceInfo::deleteAll(['internal_id' => $this->internal_id]);
	    SurgicalHistory::deleteAll(['internal_id' => $this->internal_id]);
	    TokenAssociations::deleteAll(['patient_internal_id' => $this->internal_id]);
	    Vaccinations::deleteAll(['internal_id' => $this->internal_id]);

	    return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

	public function getWeightInPouds(){
    	switch($this->weight_units){
		    case self::WEIGHT_IN_POUDS:
		    	return $this->weight;
		    case null:
			    return 0;
		    default:
			    throw new Exception('Not implemented weight unit: '.$this->weight_units, 501);
	    }
    }

    public function divideHeightToFeetAndInchs(){
	    $height_in_inches = $this->height;
    	switch ($this->height_units){
		    case self::HEIGHT_IN_INCHES:
		    	break;
		    case null:
			    return 0;
		    default:
			    throw new Exception('Not implemented height unit: '.$this->height_units, 501);
	    }

	    $feet   = intdiv($height_in_inches, 12);
    	$inches = round($height_in_inches % 12);

	    return [
	      'feet'  => $feet,
  	      'inches' => $inches
	    ];
    }

    public function getFullName(){
	    return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    public function getPhoto(){
	    $config = [
		    'region'       => getenv('BUCKET_IMAGE_REGION'),
		    'version'      => 'latest',
	    ];
	    if (($bsecret = getenv('BUCKET_SECRET_KEY')) && ($bkey = getenv('BUCKET_ACCESS_KEY')) ){
		    $credentials = new Credentials($bkey, $bsecret);
		    $config['credentials'] = $credentials;
	    }

	    $key = Helper::getS3BucketRoot().\Yii::$app->patient->internal_id.'/picture/'.$this->picture;
	    $s3 = S3Client::factory($config);

	    $result = $s3->doesObjectExist( getenv('BUCKET_IMAGE'), $key );
	    if ($result){
		    $command = $s3->getCommand('GetObject', array(
			    'Bucket'      => getenv('BUCKET_IMAGE'),
			    'Key'         => $key,
			    'ContentType'  => mimetype_from_filename(basename($key)),
			    'ResponseContentDisposition' => 'attachment; filename="'.basename($key).'"'
		    ));
		    $request = $s3->createPresignedRequest($command, "+20 minutes");
		    $signedUrl = (string) $request->getUri();
		    if ($signedUrl){
			    return $signedUrl;
		    }
	    }

	    if ($this->picture) {
		    return 'https://portal.savelifeid.com/assets/profiles/pictures/'. $this->picture;
	    } else {
		    return '/img/no_photo.jpg';
	    }
    }

    public function getProfileUrl(){
	    $profileHost = getenv('PROFILE_HOST');
	    if ($profileHost){
		    $profileHost = 'https://'.$profileHost;
	    } else {
	    	$profileHost = 'https://portal.savelifeid.com';
	    }

	    return $profileHost.'/profile/'.(!\Yii::$app->patient->isGuest ? \Yii::$app->patient->internal_id : "Unknown");
    }
}
