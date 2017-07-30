<?php

namespace app\modules\patient\models;

use app\components\EitherValidator;
use Yii;

/**
 * This is the model class for table "life_emergency_contacts".
 *
 * @property int $contact_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $contact_name
 * @property string $contact_cell
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_preferred
 * @property int $notify_email
 * @property int $notify_cell
 * @property int $added_by_user
 * @property int $display
 */
class EmergencyContacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_emergency_contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'contact_name'], 'required'],
            [['practice_id', 'notify_email', 'notify_cell', 'added_by_user', 'display'], 'integer'],
            [['internal_id', 'contact_preferred'], 'string', 'max' => 50],
	        [['contact_email'], EitherValidator::class, 'eitherAttributes' => ['contact_cell']],
            [['contact_name', 'contact_email'], 'string', 'max' => 100],
	        [['contact_email'], 'email'],
            [['contact_cell', 'contact_phone'], 'string', 'max' => 20, 'skipOnEmpty'=> true],
	        [['notify_email', 'notify_cell', 'added_by_user', 'display'], 'integer', 'min' => 0, 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => 'Contact ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'contact_name' => 'Contact Name',
            'contact_cell' => 'Cell phone',
            'contact_email' => 'E-mail',
            'contact_phone' => 'Phone',
            'contact_preferred' => 'Contact Preferred',
            'notify_email' => 'Notify by e-mail on scan',
            'notify_cell' => 'Notify by text on scan',
            'added_by_user' => 'Added By User',
            'display' => 'Display',
        ];
    }
}
