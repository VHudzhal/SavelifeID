<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_problems
// viewable flag for it in patients table is display_conditions
// Label in medical records view and profile is Medical Conditions.
// We call it conditions in code, even though table is called problems.

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
 *
 * @property string $name
 */
class Conditions extends \yii\db\ActiveRecord
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
            [['internal_id', 'practice_id', 'problem_text', 'icd10', 'problem_list_status', 'primary_problem', 'problem_source', 'problem_type', 'problem_active_date', 'problem_end_date', 'display'], 'required'],
            [['practice_id', 'display'], 'integer'],
            [['internal_id'], 'string', 'max' => 50],
            [['problem_text', 'icd10', 'problem_list_status', 'primary_problem', 'problem_source', '$roblem_type', 'problem_active_date', 'problem_end_date', ], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'problem_id' => 'Allergy ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'problem_text' => 'Problem Text',
            'icd10' => 'ICD10 Code',
            'problem_list_status' => 'Problem Status',
            'primary_problem' => 'Problem is Primary',
            'problem_source' => 'Problem Source',
            'problem_type' => 'Problem Type',
            'problem_active_date' => 'Problem Start Date',
            'problem_end_date' => 'Problem End Date',
            'display' => 'Display',

        ];
    }

	public function getName(){
		$title = [ucfirst($this->problem_text)];
		if ($this->problem_list_status) $title[] = $this->problem_list_status;
		return implode(' | ', $title);
	}

}
