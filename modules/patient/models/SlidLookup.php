<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_slid_lookup".
 *
 * @property int $row_id
 * @property string $slid
 * @property string $slid_hash
 * @property int $in_use
 * @property int $printed
 * @property int $type
 * @property string $url
 * @property string $salt
 */
class SlidLookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_slid_lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slid'], 'required'],
            [['in_use', 'printed', 'type'], 'integer'],
            [['slid'], 'string', 'max' => 15],
            [['slid_hash'], 'string', 'max' => 255],
            [['url', 'salt'], 'string', 'max' => 100],
            [['slid'], 'unique'],
            [['slid_hash'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'row_id' => 'Row ID',
            'slid' => 'Slid',
            'slid_hash' => 'Slid Hash',
            'in_use' => 'In Use',
            'printed' => 'Printed',
            'type' => 'Type',
            'url' => 'Url',
            'salt' => 'Salt',
        ];
    }
}
