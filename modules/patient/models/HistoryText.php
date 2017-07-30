<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_history_texts".
 *
 * @property integer $text_id
 * @property string $internal_id
 * @property integer $practice_id
 * @property string $text
 * @property string $type
 * @property integer $display
 *
 * @property string $name
 */
class HistoryText extends \yii\db\ActiveRecord
{
	const TYPE_SURGICAL = 'surgical';
	const TYPE_MEDICAL  = 'medical';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_history_texts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'text', 'type'], 'required'],
            [['practice_id', 'display'], 'integer'],
            [['text', 'type'], 'string'],
            [['internal_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text_id' => 'Text ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'text' => 'Text',
            'type' => 'Type',
            'display' => 'Display',
        ];
    }

    public function getName(){
    	return $this->text;
    }
}
