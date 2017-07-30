<?php

use yii\db\Migration;

class m170307_084450_patient_log_create_field_completed_registration_date extends Migration
{
    public function up()
    {
	    $this->execute("
ALTER TABLE `life_patients_log`
ADD COLUMN `completed_registration_date`  datetime NULL DEFAULT NULL AFTER `display_emergency_summary`;");
    }

    public function down()
    {
	    $this->execute("
ALTER TABLE `life_patients_log`
DROP COLUMN `completed_registration_date`;");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
