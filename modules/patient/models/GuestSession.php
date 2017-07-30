<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_guest_session".
 *
 * @property string $id
 * @property string $key
 * @property int $expire
 * @property string $data
 */
class GuestSession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_guest_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'key', 'expire'], 'required'],
            [['expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'expire' => 'Expire',
            'data' => 'Data',
        ];
    }
}
