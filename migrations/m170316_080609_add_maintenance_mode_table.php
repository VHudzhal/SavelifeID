<?php

use yii\db\Migration;

class m170316_080609_add_maintenance_mode_table extends Migration
{
    public function up()
    {
	    $this->execute("CREATE TABLE IF NOT EXISTS `life_maintenance` (
  `next_maintenance_start` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }

    public function down()
    {
	    $this->execute("DROP TABLE `life_maintenance`;");
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
