<?php

use yii\db\Migration;

class m170515_105919_add_new_type_for__patient_files__table extends Migration
{
    public function safeUp()
    {
	    $this->execute("
ALTER TABLE `life_patient_files`
MODIFY COLUMN `file_type`  enum('Advanced Directive','EKG','Other File','Insurance') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `practice_id`;");
    }

    public function safeDown()
    {
	    $this->execute("
ALTER TABLE `life_patient_files`
MODIFY COLUMN `file_type`  enum('Advanced Directive','EKG','Other File') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `practice_id`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170515_105919_add_new_type_for__patient_files__table cannot be reverted.\n";

        return false;
    }
    */
}
