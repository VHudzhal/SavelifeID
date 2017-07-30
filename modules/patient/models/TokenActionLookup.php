<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_token_action_lookup".
 *
 * @property int $action_id key
 * @property string $action_description which action has this id
 */
class TokenActionLookup extends \yii\db\ActiveRecord
{
	const ACTIVATED = 3;
	const DEACTIVATED = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_token_action_lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'action_description'], 'required'],
            [['action_id'], 'integer'],
            [['action_description'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'action_id' => 'Action ID',
            'action_description' => 'Action Description',
        ];
    }
}
