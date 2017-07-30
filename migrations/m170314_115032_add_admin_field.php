<?php

use yii\db\Migration;

class m170314_115032_add_admin_field extends Migration
{
    public function up()
    {
	    $this->execute("
ALTER TABLE `life_patients`
ADD COLUMN `is_admin`  boolean NOT NULL DEFAULT 0 AFTER `email`;");
    }

    public function down()
    {
	    $this->execute("
ALTER TABLE `life_patients`
DROP COLUMN `is_admin`;");
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
