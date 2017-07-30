<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "life_maintenance".
 *
 * @property string $next_maintenance_start
 */
class Maintenance extends \yii\db\ActiveRecord
{
	public $next_hours = 1;
	public $next_mins = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_maintenance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['next_maintenance_start'], 'required'],
            [['next_maintenance_start'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['next_maintenance_start'], 'afterCurrent'],
	        [['next_hours'], 'integer', 'min' => 1, 'max' => 48],
	        [['next_mins'],  'integer', 'min' => 0, 'max' => 59],
            [['next_maintenance_start'], 'safe'],
	        [['next_hours', 'next_mins'], 'safe'],
        ];
    }

    public function afterCurrent(){
	    $model = Maintenance::find()->orderBy(['next_maintenance_start' => SORT_DESC])->one();
    	if ($model){
		    $duration = Yii::$app->formatter->asTimestamp($this->next_maintenance_start) - Yii::$app->formatter->asTimestamp($model->next_maintenance_start);
    		if ($duration <= 0){
			    $duration = Yii::$app->formatter->asTimestamp($model->next_maintenance_start) - Yii::$app->formatter->asTimestamp(date('Y-m-d H:i:s'));
    			$hours   = floor($duration / 3600);
    			$minutes = floor(($duration % 3600) / 60);

    			$time  = Yii::t('app', '{n, plural, =0{} =1{# hour} other{# hours}}', ['n' => $hours]);
			    $time .= Yii::t('app', ' {n, plural, =0{} =1{# minute} other{# minutes}}', ['n' => $minutes]);

    			$this->addError('next_maintenance_start', Yii::t('app','Please schedule a time later than {n}', ['n' => $time]));
		    }
	    }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'next_maintenance_start' => 'Next Maintenance Start',
            'next_hours' => 'Hours',
            'next_mins' => 'Minutes',
        ];
    }

    public function afterSave( $insert, $changedAttributes ) {
	    parent::afterSave( $insert, $changedAttributes );
	    if ($insert) {
		    $model = Maintenance::find()->orderBy(['id' => SORT_DESC])->one();
	    	Maintenance::deleteAll(['<>','id', $model->id]);
	    }
    }

	public function isActive(){
    	return  Yii::$app->formatter->asTimestamp(date('Y-m-d H:i:s')) > Yii::$app->formatter->asTimestamp($this->next_maintenance_start);
    }

    public function relevateTime(){
	    $duration = Yii::$app->formatter->asTimestamp($this->next_maintenance_start) - Yii::$app->formatter->asTimestamp(date('Y-m-d H:i:s'));
	    $duration = ceil($duration / 60) * 60;
	    $hours   = floor(abs($duration) / 3600);
	    $minutes = floor((abs($duration) % 3600) / 60);
	    $time  = Yii::t('app', '{n, plural, =0{} =1{# hour} other{# hours}}', ['n' => $hours]);
	    $time .= Yii::t('app', '{n, plural, =0{} =1{ # minute} other{ # minutes}}', ['n' => $minutes]);
	    if ($duration <= 0){
		    $time = 'for '.$time;
	    } else {
		    $time = 'in '.$time;
	    }
	    return $time;
    }

    public static function isActiveAny(){
    	return (bool)Yii::$app->db->createCommand("select count(*) from life_maintenance where next_maintenance_start < now()")->queryScalar();
    }

}
