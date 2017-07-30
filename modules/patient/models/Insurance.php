<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_insurance
// viewable flag for it in patients table is display_insurance
// Label in medical records view and profile is Insurance.
// We call it insurance in code

/**
 * This is the model class for table "life_preferred_hospital".
 *
 * @property int $life_insurance_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $insurance_plan_name
 * @property string $insurance_plan_number
 * @property string $insurance_plan_member_id
 * @property string $insurance_group_id
 * @property string $insurance_phone_number
 * @property string $insurance_file_name
 * @property int $display
 *
 * @property string $name
 */
class Insurance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_insurance';
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
	        [['insurance_plan_name', 'insurance_plan_number', 'insurance_plan_member_id', 'insurance_group_id', 'insurance_phone_number', 'insurance_file_name'], 'default', 'value' => ''],
            [['practice_id', 'display'], 'integer'],
            [['internal_id', 'insurance_plan_name', 'insurance_plan_number', 'insurance_plan_member_id', 'insurance_group_id', 'insurance_phone_number', 'insurance_file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'life_insurance_id' => 'Insurance ID',
            'practice_id' => 'Practice ID',
            'internal_id' => 'Internal ID',
            'insurance_plan_name' => 'Insurance Plan Name',
            'insurance_plan_number' => 'Plan Number',
            'insurance_plan_member_id' => 'Member ID',
            'insurance_group_id' => 'Group ID',
            'insurance_phone_number' => 'Phone',
            'insurance_file_name' => 'Insurance Card Image',
            'display' => 'Display',

        ];
    }

	public function getName(){
		return ucfirst($this->insurance_plan_name);
	}

}
