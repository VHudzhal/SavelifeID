<?php

namespace app\modules\patient\models;

use Yii;

// NOTE:
// DB table is life_surgical_history
// viewable flag for it in patients table is display_procedures
// Label in medical records view and profile is Surgeries.
// We call it surgical_history in code

/**
 * This is the model class for table "life_vaccinations".
 *
 * @property int $vaccination_id
 * @property string $internal_id
 * @property string $vaccination
 * @property string $vaccination_date
 * @property int $display
 *
 * @property string $name
 */
class Vaccinations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_vaccinations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'display'], 'required'],
	        [['vaccination', 'vaccination_date'], 'default', 'value' => ''],
            [['display'], 'integer'],
            [['internal_id'], 'string', 'max' => 50],
            [['vaccination', 'vaccination_date' ], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vaccination_id' => 'Vaccination ID',
            'internal_id' => 'Internal ID',
            'vaccination' => 'Vaccination',
            'vaccination_date' => 'Vaccination Date',
            'display' => 'Display',

        ];
    }

	public function getName(){
		$title = [ucfirst($this->vaccination)];
		if ($this->vaccination_date) $title[] = $this->vaccination_date;
		return implode(' | ', $title);
	}

}
