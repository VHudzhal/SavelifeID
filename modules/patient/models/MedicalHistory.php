<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_medical_history
// viewable flag for it in patients table is display_medical_history
// Label in medical records view and profile is Medical History.
// We call it medical_history in code

/**
 * This is the model class for table "life_problems".
 *
 * @property int $medical_history_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $description
 * @property string $date_onset
 * @property int $display
 *
 * @property string $name
 */
class MedicalHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_medical_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'practice_id', 'display'], 'required'],
	        [['description', 'date_onset'], 'default', 'value' => ''],
            [['practice_id', 'display'], 'integer'],
            [['internal_id', 'date_onset'], 'string', 'max' => 50],
            [['description' ], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'medical_history_id' => 'Medical History ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'description' => 'Description',
            'date_onset' => 'Date',
            'display' => 'Display',

        ];
    }

	public function getName(){
		$title = [ucfirst($this->description)];
		if ($this->date_onset) $title[] = $this->date_onset;
		return implode(' | ', $title);
	}

}
