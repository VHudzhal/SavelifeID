<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_surgical_history
// viewable flag for it in patients table is display_procedures
// Label in medical records view and profile is Surgeries.
// We call it surgical_history in code

/**
 * This is the model class for table "life_surgical_history".
 *
 * @property int $life_surgical_history_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $description
 * @property string $date_onset
 * @property string $performing_physician
 * @property string $performing_location
 * @property int $display
 *
 * @property string $name
 */
class SurgicalHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_surgical_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'practice_id', 'display'], 'required'],
	        [['description', 'date_onset', 'performing_physician', 'performing_location'], 'default', 'value' => ''],
            [['practice_id', 'display'], 'integer'],
            [['internal_id', 'date_onset'], 'string', 'max' => 50],
            [['performing_physician', 'performing_location'], 'string', 'max' => 100],
            [['description' ], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'life_surgical_history_id' => 'Surgical History ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'description' => 'Description',
            'date_onset' => 'Date',
            'performing_physician' => 'Physician',
            'performing_location' => 'Location',
            'display' => 'Display',

        ];
    }

	public function getName(){
		$title = [ucfirst($this->description)];
		if ($this->date_onset) $title[] = $this->date_onset;

		return implode(' | ', $title);
	}

}
