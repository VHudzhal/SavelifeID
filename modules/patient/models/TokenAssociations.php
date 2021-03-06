<?php

namespace app\modules\patient\models;

use app\modules\patient\models\Log\TokenStatusLog;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "life_token_associations".
 *
 * @property int $association_id key
 * @property string $token_id internal_id_hash of the token being attached to a patient
 * @property string $token_slid slid of the token -- token_id = hash(token_slid)
 * @property int $patient_id patient_id of the patient the token is being attached to, null means token not attached to a patient yet
 * @property string $patient_internal_id internal_id of the patient, NULL means device allocated but not attached yet
 * @property int $enrollment if this token is the first for the patient -- the enrollment token, special. Means the slid# of this token is internal_id in patients, and token_id is the internal_id_hash
 * @property int $active set to zero if the token cannot be used to return medical data (inactive)
 * @property int $token_type lookup into the token_types table (where text is found). NULL means Unknown
 * @property string $description user-supplied description of the token (replacement purple bracelet)
 *
 * @property \app\modules\patient\models\TokenTypes $type
 * @property \app\modules\patient\models\TokenActionLookup $status
 */
class TokenAssociations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_token_associations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_id', 'token_slid', 'enrollment', 'active', 'description'], 'required'],
            [['patient_id', 'enrollment', 'active', 'token_type'], 'integer'],
            [['token_id', 'description'], 'string', 'max' => 255],
            [['token_slid', 'patient_internal_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'association_id' => 'Association ID',
            'token_id' => 'Token ID',
            'token_slid' => 'Token Slid',
            'patient_id' => 'Patient ID',
            'patient_internal_id' => 'Patient Internal ID',
            'enrollment' => 'Enrollment',
            'active' => 'Active',
            'token_type' => 'Token Type',
            'description' => 'Description',
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getType(){
		return $this->hasOne(TokenTypes::className(), ['token_type' => 'token_type']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getStatus(){
		return $this->hasOne(TokenActionLookup::className(), ['action_id' => 'active']);
	}

	public function hiddenSlid(){
		return substr_replace($this->token_slid, '***',-3);
	}

	public function afterSave( $insert, $changedAttributes ) {
		if (isset($changedAttributes["active"])) {
			(new TokenStatusLog(['token' => $this]))->save();
			$activityModel = new TokenActivity();
			$activityModel->token_id = $this->token_id;
			$activityModel->patient_id = $this->patient_id;
			$activityModel->action = $this->active?TokenActionLookup::ACTIVATED:TokenActionLookup::DEACTIVATED;
			$activityModel->activity_date = new Expression('NOW()');
			if (!$activityModel->save()){
				var_dump($activityModel->errors); die();
			}
		}

		parent::afterSave( $insert, $changedAttributes ); // TODO: Change the autogenerated stub
	}

}
