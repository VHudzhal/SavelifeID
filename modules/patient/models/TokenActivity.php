<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_token_activity".
 *
 * @property int $activity_id key
 * @property string $token_id token being acted on
 * @property int $patient_id owner of token
 * @property int $action lookup in life_token_action_lookup to learn what was done
 * @property string $activity_date when it happened
 */
class TokenActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_token_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_id', 'patient_id', 'action', 'activity_date'], 'required'],
            [['activity_id', 'patient_id', 'action'], 'integer'],
            [['activity_date'], 'safe'],
            [['token_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_id' => 'Activity ID',
            'token_id' => 'Token ID',
            'patient_id' => 'Patient ID',
            'action' => 'Action',
            'activity_date' => 'Activity Date',
        ];
    }
}
