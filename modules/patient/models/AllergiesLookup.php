<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_allergies_lookup".
 *
 * @property int $row_id
 * @property string $allergy
 * @property string $reaction
 */
class AllergiesLookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_allergies_lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['allergy', 'reaction'], 'required'],
            [['allergy', 'reaction'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'row_id' => 'Row ID',
            'allergy' => 'Allergy',
            'reaction' => 'Reaction',
        ];
    }
}
