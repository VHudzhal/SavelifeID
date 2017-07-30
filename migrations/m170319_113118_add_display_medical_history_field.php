<?php

use yii\db\Migration;

class m170319_113118_add_display_medical_history_field extends Migration
{
    public function up()
    {
	    $this->execute("
ALTER TABLE `life_patients`
ADD COLUMN `display_medical_history` boolean NULL DEFAULT NULL AFTER `display_medications`;");    
    }

    public function down()
    {
	    $this->execute("
ALTER TABLE `life_patients`
DROP COLUMN `display_medical_history`;");
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
