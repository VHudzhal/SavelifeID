<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_problems".
 *
 * @property int $problem_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $problem_text
 * @property string $icd10
 * @property string $problem_list_status
 * @property string $primary_problem
 * @property string $problem_source
 * @property string $problem_type
 * @property string $problem_active_date
 * @property string $problem_end_date
 * @property int $display
 */
class Problems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_problems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'practice_id', 'problem_active_date', 'problem_end_date', 'display'], 'required'],
	        [['problem_text', 'icd10', 'problem_list_status', 'primary_problem', 'problem_source', 'problem_type'], 'default', 'value' => ''],
            [['practice_id', 'display'], 'integer'],
            [['problem_active_date', 'problem_end_date'], 'safe'],
            [['internal_id'], 'string', 'max' => 50],
            [['problem_text', 'icd10', 'problem_list_status', 'primary_problem', 'problem_source', 'problem_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'problem_id' => 'Problem ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'problem_text' => 'Problem Text',
            'icd10' => 'Icd10',
            'problem_list_status' => 'Problem List Status',
            'primary_problem' => 'Primary Problem',
            'problem_source' => 'Problem Source',
            'problem_type' => 'Problem Type',
            'problem_active_date' => 'Problem Active Date',
            'problem_end_date' => 'Problem End Date',
            'display' => 'Display',
        ];
    }
}
