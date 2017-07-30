<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_partners".
 *
 * @property int $partner_id
 * @property string $partner_name
 * @property string $auth_user
 * @property string $auth_pass
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_name', 'auth_user', 'auth_pass'], 'required'],
            [['partner_name'], 'string', 'max' => 100],
            [['auth_user', 'auth_pass'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partner_id' => 'Partner ID',
            'partner_name' => 'Partner Name',
            'auth_user' => 'Auth User',
            'auth_pass' => 'Auth Pass',
        ];
    }
}
