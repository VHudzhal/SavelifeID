<?php

use yii\db\Migration;
use app\modules\patient\models\HistoryText;

class m170615_103703_create_table__life_history_text extends Migration
{
    public function safeUp()
    {
	    if (!\app\components\MigrationHelper::fieldExists('life_patients_log', 'link_exp_date')){
		    $this->execute("ALTER TABLE `life_patients_log` 
				ADD COLUMN `support_request` tinyint NOT NULL DEFAULT '1' AFTER `completed_registration_date`,
				ADD COLUMN `link_exp_date` datetime NULL AFTER `support_request`;");
	    }
	    $this->execute("
CREATE TABLE `life_history_texts` (
`text_id`  int NOT NULL AUTO_INCREMENT ,
`internal_id`  varchar(50) NOT NULL ,
`practice_id`  int NOT NULL DEFAULT 0 ,
`text`  text NOT NULL ,
`type`  enum('medical','surgical') NOT NULL ,
`display`  tinyint NOT NULL DEFAULT 0 ,
PRIMARY KEY (`text_id`),
INDEX (`internal_id`) 
)
ENGINE=InnoDB
");
	    $patients = \app\modules\patient\models\Patient::find()->all();
	    foreach ($patients as $patient){
	    	/** @var $patient \app\modules\patient\models\Patient */

	    	if ($patient->surgical_history_text){
			    $model = new \app\modules\patient\models\HistoryText();
			    $model->internal_id = $patient->internal_id;
			    $model->practice_id = 0;
			    $model->text = $patient->surgical_history_text;
			    $model->type = \app\modules\patient\models\HistoryText::TYPE_SURGICAL;
			    $model->display = 1;
			    $model->save();
		    }

		    if ($patient->medical_history_text) {
			    $model = new \app\modules\patient\models\HistoryText();
			    $model->internal_id = $patient->internal_id;
			    $model->practice_id = 0;
			    $model->text = $patient->medical_history_text;
			    $model->type = \app\modules\patient\models\HistoryText::TYPE_MEDICAL;
			    $model->display = 1;
			    $model->save();
		    }
	    }

	    if (!\app\components\MigrationHelper::fieldExists('life_patients', 'medical_history_text')) {
		    $this->execute( "ALTER TABLE `life_patients`
					DROP COLUMN IF EXISTS `medical_history_text`,
					DROP COLUMN IF EXISTS `surgical_history_text`;" );
	    }
	    if (!\app\components\MigrationHelper::fieldExists('life_patients_log', 'medical_history_text')) {
		    $this->execute( "ALTER TABLE `life_patients_log`
					DROP COLUMN IF EXISTS `medical_history_text`,
					DROP COLUMN IF EXISTS `surgical_history_text`;" );
	    }
    }

    public function safeDown()
    {
	    if (!\app\components\MigrationHelper::fieldExists('life_patients', 'medical_history_text')) {
		    $this->execute( "ALTER TABLE `life_patients`
					ADD COLUMN `medical_history_text`  text NULL AFTER `link_exp_date`,
					ADD COLUMN `surgical_history_text`  text NULL AFTER `medical_history_text`;" );
	    }
	    if (!\app\components\MigrationHelper::fieldExists('life_patients_log', 'medical_history_text')) {
		    $this->execute( "ALTER TABLE `life_patients_log`
					ADD COLUMN `medical_history_text`  text NULL,
					ADD COLUMN `surgical_history_text`  text NULL AFTER `medical_history_text`;" );
	    }
	    $patients = \app\modules\patient\models\Patient::find()->all();
	    foreach ($patients as $patient) {
		    /** @var $patient \app\modules\patient\models\Patient */
		    $text = HistoryText::findOne(['internal_id' => $patient->internal_id, 'type' => HistoryText::TYPE_SURGICAL]);
		    $patient->surgical_history_text = ($text && $text->text)?$text->text:$patient->surgical_history_text;

		    $text = HistoryText::findOne(['internal_id' => $patient->internal_id, 'type' => HistoryText::TYPE_MEDICAL]);
		    $patient->medical_history_text = ($text && $text->text)?$text->text:$patient->medical_history_text;

		    $patient->save();
	    }
	    $this->execute( "DROP TABLE IF EXISTS `life_history_texts`" );
	    if (\app\components\MigrationHelper::fieldExists('life_patients_log', 'link_exp_date')){
	        $this->execute("ALTER TABLE `life_patients_log` DROP COLUMN `link_exp_date`");
		    $this->execute("ALTER TABLE `life_patients_log` DROP COLUMN `support_request`");
	    }
    }
}
