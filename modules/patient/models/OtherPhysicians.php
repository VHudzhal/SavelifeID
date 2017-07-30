<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_other_physicians".
 *
 * @property int $physician_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $physician_name
 * @property string $physician_phone
 * @property string $physician_specialty
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $office_phone
 * @property string $cell_phone
 * @property string $email
 * @property int $main_physician
 * @property int $allow_alerts
 * @property int $display
 *
 * @property string $name
 */
class OtherPhysicians extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_other_physicians';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id'], 'required'],
	        [['physician_name', 'physician_phone', 'physician_specialty', 'address', 'city', 'state', 'zip'], 'default', 'value' => ''],
            [['practice_id', 'main_physician', 'allow_alerts', 'display'], 'integer'],
            [['internal_id', 'city', 'state'], 'string', 'max' => 50],
            [['physician_name', 'physician_specialty', 'address', 'email'], 'string', 'max' => 100],
	        [['email'], 'email'],
            [['physician_phone', 'zip', 'office_phone', 'cell_phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'physician_id' => 'Physician ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'physician_name' => 'Name',
            'physician_phone' => 'Phone',
            'physician_specialty' => 'Specialty',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'office_phone' => 'Office Phone',
            'cell_phone' => 'Cell Phone',
            'email' => 'Email',
            'main_physician' => 'Main Physician',
            'allow_alerts' => 'Allow Alerts',
            'display' => 'Display',
        ];
    }

	public function getName(){
		return $this->physician_name;
	}

}
