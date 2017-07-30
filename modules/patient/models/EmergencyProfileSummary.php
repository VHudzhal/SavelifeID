<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_emergency_profile_summary".
 *
 * @property int $id
 * @property string $internal_id
 * @property string $emergency_item
 * @property int $life_emergency_profile_summary_lookup_id
 */
class EmergencyProfileSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_emergency_profile_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'emergency_item'], 'required'],
            [['life_emergency_profile_summary_lookup_id'], 'integer'],
            [['internal_id'], 'string', 'max' => 50],
            [['emergency_item'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'internal_id' => 'Internal ID',
            'emergency_item' => 'Emergency Item',
            'life_emergency_profile_summary_lookup_id' => 'Life Emergency Profile Summary Lookup ID',
        ];
    }

    public function getName(){
    	return $this->emergency_item;
    }

    public function getDisplay(){
    	return 1;
    }
}
