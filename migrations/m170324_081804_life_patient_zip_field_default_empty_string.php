<?php

use yii\db\Migration;

class m170324_081804_life_patient_zip_field_default_empty_string extends Migration
{
    public function up()
    {
	    $this->execute("ALTER TABLE `life_patients` MODIFY COLUMN `zip`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `state`;");
    }

    public function down()
    {
	    $this->execute("ALTER TABLE `life_patients` MODIFY COLUMN `zip`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `state`;");
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
