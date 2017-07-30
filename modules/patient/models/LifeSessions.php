<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_sessions".
 *
 * @property string $session_id
 * @property int $patient_id
 * @property string $last_updated
 *
 * @property Patient $patient
 */
class LifeSessions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_sessions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'patient_id'], 'required'],
            [['patient_id'], 'integer'],
            [['last_updated'], 'safe'],
            [['session_id'], 'string', 'max' => 20],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'patients_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'session_id' => 'Session ID',
            'patient_id' => 'Patient ID',
            'last_updated' => 'Last Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['patients_id' => 'patient_id']);
    }
}
