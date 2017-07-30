<?php

use yii\db\Migration;

class m170529_105347_add_primary_key_to__life_maintenance__table extends Migration
{
    public function safeUp()
    {
    	$this->execute("ALTER TABLE `life_maintenance`
ADD COLUMN `id`  int NOT NULL AUTO_INCREMENT FIRST ,
ADD PRIMARY KEY (`id`);");
	    $this->execute("
ALTER TABLE `life_maintenance`
MODIFY COLUMN `next_maintenance_start`  datetime NOT NULL AFTER `id`;");
    }

    public function safeDown()
    {
    	$this->execute("
ALTER TABLE `life_maintenance`
ADD COLUMN `id`  int NOT NULL AUTO_INCREMENT FIRST ,
ADD PRIMARY KEY (`id`);
");
    	$this->execute("
ALTER TABLE `life_maintenance`
MODIFY COLUMN `next_maintenance_start`  datetime NULL AFTER `id`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170529_105347_add_primary_key_to__life_maintenance__table cannot be reverted.\n";

        return false;
    }
    */
}
