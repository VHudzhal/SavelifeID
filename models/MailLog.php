<?php

namespace app\models;

use app\components\SerializeBehavior;
use Yii;

/**
 * This is the model class for table "life_mail_log".
 *
 * @property integer $patients_id
 * @property string $subject
 * @property string $template
 * @property integer $attempts
 * @property string $send_time
 * @property string $data
 * @property string $callback
 * @property integer $sended
 * @property string $sended_time
 * @property string $callback_log
 * @property string $log
 */
class MailLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_mail_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patients_id', 'subject', 'template', 'attempts', 'send_time'], 'required'],
            [['patients_id', 'attempts', 'sended'], 'integer'],
            [['send_time', 'sended_time'], 'safe'],
            [['subject', 'callback'], 'string', 'max' => 200],
            [['template'], 'string', 'max' => 50],
            [['callback_log', 'log'], 'string', 'max' => 4096],
	        [['data'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patients_id' => 'Patients ID',
            'subject' => 'Subject',
            'template' => 'Template',
            'attempts' => 'Attempts',
            'send_time' => 'Send Time',
            'data' => 'Data',
            'callback' => 'Callback',
            'sended' => 'Sended',
            'sended_time' => 'Sended Time',
            'callback_log' => 'Callback Log',
            'log' => 'Log',
        ];
    }

	public function behaviors()
	{
		return [
			'serializedAttributes' => [
				'class' => SerializeBehavior::className(),
				'attributes' => ['data'],
				'encode' => true,
			],
		];
	}

}
