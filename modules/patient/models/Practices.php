<?php

namespace app\modules\patient\models;

use Yii;

/**
 * This is the model class for table "life_practices".
 *
 * @property int $practice_id
 * @property string $practice_name
 * @property string $practice_umr_id
 * @property string $auth_user
 * @property string $auth_pass
 * @property int $enrollment_code
 * @property int $partner_id
 * @property int $demo
 */
class Practices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_practices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practice_name', 'practice_umr_id', 'auth_user', 'auth_pass', 'partner_id'], 'required'],
            [['enrollment_code', 'partner_id', 'demo'], 'integer'],
            [['practice_name'], 'string', 'max' => 255],
            [['practice_umr_id', 'auth_user', 'auth_pass'], 'string', 'max' => 50],
            [['enrollment_code', 'auth_user', 'practice_umr_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'practice_id' => 'Practice ID',
            'practice_name' => 'Name',
            'practice_umr_id' => 'UMR ID',
            'auth_user' => 'User',
            'auth_pass' => 'Password',
            'enrollment_code' => 'Enroll',
            'partner_id' => 'Partner ID',
            'demo' => 'Demo',
        ];
    }

    public function fill(){
	    $this->practice_name = "New Practice Name";
	    $this->practice_umr_id = Yii::$app->security->generateRandomString(50);
	    $this->auth_user       = Yii::$app->security->generateRandomString(50);
	    $this->auth_pass = Yii::$app->security->generateRandomString(20);
	    $this->enrollment_code = rand(100000, 999999);
	    $this->partner_id = 1;
	    $this->demo = 0;

	    if (Practices::findOne(['practice_umr_id' => $this->practice_umr_id])) return $this->fill();
	    if (Practices::findOne(['auth_user' => $this->auth_user])) return $this->fill();
	    if (Practices::findOne(['enrollment_code' => $this->enrollment_code])) return $this->fill();
	    return $this;
    }
}
