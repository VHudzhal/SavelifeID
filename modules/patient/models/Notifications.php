<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_notifications".
 *
 * @property int $life_notification_id
 * @property string $internal_id
 * @property string $notification_name
 * @property string $notification_email
 * @property string $notification_text
 * @property string $last_updated
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'notification_name', 'notification_email', 'notification_text', 'last_updated'], 'required'],
            [['last_updated'], 'safe'],
            [['internal_id', 'notification_name', 'notification_email'], 'string', 'max' => 100],
            [['notification_text'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'life_notification_id' => 'Life Notification ID',
            'internal_id' => 'Internal ID',
            'notification_name' => 'Notification Name',
            'notification_email' => 'Notification Email',
            'notification_text' => 'Notification Text',
            'last_updated' => 'Last Updated',
        ];
    }
}
