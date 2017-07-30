<?php

namespace app\models;

use app\components\SerializeBehavior;
use Yii;

/**
 * This is the model class for table "life_mail_queue".
 *
 * @property string $id
 * @property integer $patients_id
 * @property string $subject
 * @property string $template
 * @property integer $attempts
 * @property string $send_time
 * @property string $data
 * @property string $callback
 */
class MailQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_mail_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patients_id', 'subject', 'template', 'attempts', 'send_time'], 'required'],
            [['patients_id', 'attempts'], 'integer'],
            [['send_time'], 'safe'],
            [['subject', 'callback'], 'string', 'max' => 200],
            [['template'], 'string', 'max' => 50],
	        [['data'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patients_id' => 'Patients ID',
            'subject' => 'Subject',
            'template' => 'Template',
            'attempts' => 'Attempts',
            'send_time' => 'Send Time',
            'data' => 'Data',
            'callback' => 'Callback',
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
