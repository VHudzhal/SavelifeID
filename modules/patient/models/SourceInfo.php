<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_source_info".
 *
 * @property int $life_source_info_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $source_date
 * @property string $source_practice_direct_address
 * @property string $source_office_name
 * @property string $source_office_address_1
 * @property string $source_office_address_2
 * @property string $source_office_city
 * @property string $source_office_state
 * @property string $source_office_zip
 * @property string $source_office_phone
 * @property string $source_office_fax
 * @property string $source_last_name
 * @property string $source_first_name
 * @property string $source_middle_initial
 * @property string $source_prefix
 * @property string $source_suffix
 * @property string $source_direct_address
 * @property string $source_specialty
 * @property string $source_cell_phone
 */
class SourceInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_source_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'practice_id', 'source_date', 'source_practice_direct_address', 'source_office_name', 'source_office_address_1', 'source_office_address_2', 'source_office_city', 'source_office_state', 'source_office_zip', 'source_office_phone', 'source_office_fax', 'source_last_name', 'source_first_name', 'source_middle_initial', 'source_prefix', 'source_suffix', 'source_direct_address', 'source_specialty', 'source_cell_phone'], 'required'],
            [['practice_id'], 'integer'],
            [['source_date'], 'safe'],
            [['internal_id', 'source_office_state', 'source_cell_phone'], 'string', 'max' => 50],
            [['source_practice_direct_address', 'source_direct_address'], 'string', 'max' => 255],
            [['source_office_name', 'source_office_address_1', 'source_office_address_2', 'source_office_city', 'source_last_name', 'source_first_name', 'source_specialty'], 'string', 'max' => 100],
            [['source_office_zip', 'source_middle_initial', 'source_prefix', 'source_suffix'], 'string', 'max' => 10],
            [['source_office_phone', 'source_office_fax'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'life_source_info_id' => 'Life Source Info ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'source_date' => 'Source Date',
            'source_practice_direct_address' => 'Source Practice Direct Address',
            'source_office_name' => 'Source Office Name',
            'source_office_address_1' => 'Source Office Address 1',
            'source_office_address_2' => 'Source Office Address 2',
            'source_office_city' => 'Source Office City',
            'source_office_state' => 'Source Office State',
            'source_office_zip' => 'Source Office Zip',
            'source_office_phone' => 'Source Office Phone',
            'source_office_fax' => 'Source Office Fax',
            'source_last_name' => 'Source Last Name',
            'source_first_name' => 'Source First Name',
            'source_middle_initial' => 'Source Middle Initial',
            'source_prefix' => 'Source Prefix',
            'source_suffix' => 'Source Suffix',
            'source_direct_address' => 'Source Direct Address',
            'source_specialty' => 'Source Specialty',
            'source_cell_phone' => 'Source Cell Phone',
        ];
    }
}
