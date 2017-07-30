<?php

use yii\db\Migration;

class m170321_110605_life_patient_files_type_enum extends Migration
{
    public function up()
    {
	    $this->execute("ALTER TABLE `life_patient_files`
MODIFY COLUMN `file_type`  enum('Advanced Directive','EKG','Other File') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `practice_id`;
");
	    $this->execute("ALTER TABLE `life_patient_files` ADD INDEX `internal_id+file_type` (`internal_id`, `file_type`) ;");
    }

    public function down()
    {
	    $this->execute("ALTER TABLE `life_patient_files`
MODIFY COLUMN `file_type`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `practice_id`;
");
	    $this->execute("ALTER TABLE `life_patient_files` DROP INDEX `internal_id+file_type` ;");
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
