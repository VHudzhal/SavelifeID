<?php

use yii\db\Migration;

class m170303_093331_patient_change_field_gender extends Migration
{
    public function up()
    {
	    $this->execute("
ALTER TABLE `life_patients`
MODIFY COLUMN `gender`  enum('Female','Male') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `cell_phone`;
");
    }

    public function down()
    {
        echo "m170303_093331_patient_change_field_gender cannot be reverted.\n";
	    $this->execute("
ALTER TABLE `life_patients`
MODIFY COLUMN `gender` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `cell_phone`;
");
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
