<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_token_types".
 *
 * @property int $token_type lookup index
 * @property string $text text to use when referring to tokens of this type
 * @property int $includes_printed_slid is slid printed on it? (Useful question for registration, whether the ID is available for validation)
 */
class TokenTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_token_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_type', 'text', 'includes_printed_slid'], 'required'],
            [['token_type', 'includes_printed_slid'], 'integer'],
            [['text'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token_type' => 'Token Type',
            'text' => 'Text',
            'includes_printed_slid' => 'Includes Printed Slid',
        ];
    }
}
