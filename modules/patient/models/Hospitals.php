<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_preferred_hospital
// viewable flag for it in patients table is display_hospital
// Label in medical records view and profile is Hospitals.
// We call it hospitals in code

/**
 * This is the model class for table "life_preferred_hospital".
 *
 * @property int $hospital_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $hospital_name
 * @property string $hospital_address_1
 * @property string $hospital_address_2
 * @property string $hospital_city
 * @property string $hospital_state
 * @property string $hospital_zip
 * @property string $hospital_phone
 * @property string $hospital_comment
 * @property int $display
 *
 * @property string $name
 */
class Hospitals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_preferred_hospital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 
              'practice_id', 
              'display'], 'required'],
	        [['hospital_name','hospital_address_1','hospital_address_2','hospital_city','hospital_state','hospital_zip','hospital_phone','hospital_comment',], 'default', 'value' => ''],
	        [['practice_id', 'display'], 'integer'],
	        [['internal_id', 'hospital_state'], 'string', 'max' => 50],
            [['hospital_zip', 'hospital_phone'], 'string', 'max' => 20],
            [['hospital_city'], 'string', 'max' => 100],
            [['hospital_comment'], 'string'],
            [['hospital_name', 'hospital_address_1', 'hospital_address_2' ], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hospital_id' => 'Hospital ID',
            'practice_id' => 'Practice ID',
            'internal_id' => 'Internal ID',
            'hospital_name' => 'Hospital Name',
            'hospital_address_1' => 'Address 1',
            'hospital_address_2' => 'Address 2',
            'hospital_city' => 'City',
            'hospital_state' => 'State',
            'hospital_zip' => 'Zip',
            'hospital_phone' => 'Phone',
            'hospital_comment' => 'Hospital Comment',
            'display' => 'Display',

        ];
    }

	public function getName(){
		$title = [ucfirst($this->hospital_name)];
		if ($this->hospital_state) $title[] = $this->hospital_state;

		return implode(' | ', $title);
	}

}
