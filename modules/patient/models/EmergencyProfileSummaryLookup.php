<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_emergency_profile_summary_lookup".
 *
 * @property int $life_emergency_profile_summary_lookup_id
 * @property string $life_emergency_profile_summary_lookup_item
 */
class EmergencyProfileSummaryLookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_emergency_profile_summary_lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['life_emergency_profile_summary_lookup_item'], 'required'],
            [['life_emergency_profile_summary_lookup_item'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'life_emergency_profile_summary_lookup_id' => 'Life Emergency Profile Summary Lookup ID',
            'life_emergency_profile_summary_lookup_item' => 'Life Emergency Profile Summary Lookup Item',
        ];
    }
}
