<?php

use yii\db\Migration;

class m170303_092206_patient_change_fields_height_weight extends Migration
{
    public function up()
    {
	    $this->execute("
ALTER TABLE `life_patients`
MODIFY COLUMN `height`  int(11) NOT NULL DEFAULT 0 AFTER `zip`,
MODIFY COLUMN `height_units`  enum('inches') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'inches' AFTER `height`,
MODIFY COLUMN `weight`  int(11) NOT NULL DEFAULT 0 AFTER `height_units`,
MODIFY COLUMN `weight_units`  enum('pounds') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pounds' AFTER `weight`;
");
    }

    public function down()
    {
	    $this->execute("
ALTER TABLE `life_patients`
MODIFY COLUMN `height` varchar(20) NOT NULL DEFAULT 0 AFTER `zip`,
MODIFY COLUMN `height_units` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'inches' AFTER `height`,
MODIFY COLUMN `weight` varchar(20) NOT NULL DEFAULT 0 AFTER `height_units`,
MODIFY COLUMN `weight_units` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pounds' AFTER `weight`;
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
