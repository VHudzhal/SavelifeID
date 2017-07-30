<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_allergies".
 *
 * @property int $allergy_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $allergies_text
 * @property string $allergies_severity
 * @property string $allergies_reaction
 * @property string $date_of_onset
 * @property string $rx_norm_code
 * @property string $snomed_code
 * @property string $ncdid
 * @property int $display
 *
 * @property string $name
 */
class Allergies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_allergies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'practice_id', 'display'], 'required'],
	        [['allergies_text', 'allergies_severity', 'allergies_reaction', 'date_of_onset', 'rx_norm_code', 'snomed_code', 'ncdid'], 'default', 'value' => ''],
            [['practice_id', 'display'], 'integer'],
            [['allergies_text'], 'string'],
            [['internal_id'], 'string', 'max' => 50],
            [['allergies_severity', 'allergies_reaction', 'date_of_onset', 'rx_norm_code', 'snomed_code', 'ncdid'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'allergy_id' => 'Allergy ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'allergies_text' => 'Allergies Text',
            'allergies_severity' => 'Allergies Severity',
            'allergies_reaction' => 'Allergies Reaction',
            'date_of_onset' => 'Date Of Onset',
            'rx_norm_code' => 'Rx Norm Code',
            'snomed_code' => 'Snomed Code',
            'ncdid' => 'Ncdid',
            'display' => 'Display',
        ];
    }

    public function getName(){
	    $title = [ucfirst($this->allergies_text)];
	    if ($this->allergies_reaction) $title[] = $this->allergies_reaction;
	    if ($this->allergies_severity) $title[] = $this->allergies_severity;
	    $title = implode(' | ', $title);
    	return $title;
    }
}
