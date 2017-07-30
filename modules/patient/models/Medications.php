<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_medical_history
// viewable flag for it in patients table is display_medical_history
// Label in medical records view and profile is Medical History.
// We call it medical_history in code

/**
 * This is the model class for table "life_problems".
 *
 * @property int $medical_history_id
 * @property string $internal_id
 * @property int    $practice_id
 * @property string $medication_text
 * @property string $medication_strength
 * @property string $medication_route
 * @property string $medication_duration
 * @property string $dose_unit
 * @property string $dose_timing
 * @property string $num_refills
 * @property string $date_prescribed
 * @property string $rx_norm_code
 * @property string $ncdid
 * @property string $direction_to_patient
 * @property int $display
 *
 * @property string $name
 */
class Medications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_medications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'internal_id',         // gavgav review: NOTE: internal id is varchar(50) in some places and (100) in others
               'date_prescribed',     // making a "date" field be string limited to 100 as far as model is concerned.  This is a bit vague, but should work
               'display'], 'required'],
	        [[ 'practice_id', 'medication_text', 'medication_strength', 'medication_route', 'medication_duration',
		       'dose_unit', 'dose_timing', 'num_refills', 'rx_norm_code', 'ncdid', 'direction_to_patient'], 'default', 'value' => ''],
            [[ 'practice_id', 'display'], 'integer'],
            [[ 'internal_id', 
               'medication_strength', 
               'medication_route', 
               'medication_duration', 
               'dose_unit', 
               'dose_timing', 
               'num_refills', 
               'rx_norm_code',
               'date_prescribed', 
               'ncdid' ], 'string', 'max' => 100],
            [[ 'medication_text' ], 'string', 'max' => 255],
            [[ 'direction_to_patient' ], 'string'],
        ];                                   
    }                                        
                                             
    /**                                      
     * @inheritdoc                           
     */                                      
    public function attributeLabels()        
    {                                        
        return [
             'life_medication_id' => 'Medication ID',
             'internal_id' => 'Internal ID',
             'practice_id' => 'Practice ID',
             'medication_text' => 'Medication Name', 
             'medication_strength' => 'Medication Strength', 
             'medication_route' => 'Medication Route', 
             'medication_duration' => 'Medication Duration', 
             'dose_unit' => 'Dose Unit', 
             'dose_timing' => 'Dose Timing', 
             'num_refills' => 'Num Refills', 
             'date_prescribed' => 'Date Prescribed',
             'rx_norm_code' => 'Rx Norm Code', 
             'ncdid' => 'NCDID', 
             'direction_to_patient' => 'Directions', 
             'display' => 'Display',

        ];
    }

	public function getName(){
		$title = [ucfirst($this->medication_text)];
		if ($this->medication_strength) $title[] = $this->medication_strength;
		if ($this->dose_timing) $title[] = $this->dose_timing;
		return implode(' | ', $title);
	}
}
