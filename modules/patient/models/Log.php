<?php

namespace app\modules\patient\models;

use ruskid\YiiBehaviors\IpBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "life_log".
 *
 * @property int $log_id
 * @property int $patients_id
 * @property string $internal_id
 * @property string $log_updated
 * @property string $log_content
 * @property string $log_type
 * @property string $ip_address
 * @property int $practice_id
 * @property int $emergency_check
 * @property int $send_notifications
 * @property int $notified
 */
class Log extends \yii\db\ActiveRecord
{
	const AGGREGATE_TIMEOUT = 10*60;

	const TYPE_PROFILE_VISIBILITY_CHANGE = 'profile_visibility_change';
	const TYPE_USER_KEYWORD_CHANGE = 'user_keyword_change';
	const TYPE_EMERGENCY_CONTACTS = 'Emergency Contact Change';
	const TYPE_NOTIFICATIONS = 'Self Notification Change';
	const TYPE_PROFILE_CATEGORY_VISIBILITY_CHANGE = 'Profile Category Visibility Change';
	const TYPE_PROFILE_ITEM_VISIBILITY_CHANGE = 'Profile Item Visibility Change';
	const TYPE_TOKEN_STATUS_CHANGE = 'Token status changed';
	const TYPE_SUPPORT_IDENTITY_CHECK = 'Support Identity Check';
	const TYPE_S3_DELETION = 's3 deletion';
	const TYPE_CHANGE_CARD_LOG_FAILURE = 'Payment Card Change Failed';
	const TYPE_CHANGE_CARD_LOG_SUCCESS = 'Payment Card Changed';
	const TYPE_CHANGE_BILLING_SCHEDULE_FAILURE = 'Payment Schedule Change Failed';
	const TYPE_CHANGE_BILLING_SCHEDULE_SUCCESS = 'Payment Schedule Changed';
	const TYPE_PAYMENT_CANCEL_FAILURE = 'Payment Cancel Failed';
	const TYPE_PAYMENT_CANCEL_SUCCESS = 'Payment Cancelled';
	const TYPE_PASSWORD_CHANGE = 'Password Changed';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patients_id', 'internal_id', 'log_updated', 'log_type', 'ip_address', 'practice_id', 'emergency_check', 'send_notifications', 'notified'], 'required'],
            [['patients_id', 'practice_id', 'emergency_check', 'send_notifications', 'notified'], 'integer'],
            [['log_updated'], 'safe'],
            [['log_content'], 'string'],
            [['internal_id'], 'string', 'max' => 100],
//            [['log_type'], 'in', 'range' => []],
            [['ip_address'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'patients_id' => 'Patients ID',
            'internal_id' => 'Internal ID',
            'log_updated' => 'Log Updated',
            'log_content' => 'Log Content',
            'log_type' => 'Log Type',
            'ip_address' => 'Ip Address',
            'practice_id' => 'Practice ID',
            'emergency_check' => 'Emergency Check',
            'send_notifications' => 'Send Notifications',
            'notified' => 'Notified',
        ];
    }
}
