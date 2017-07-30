<?php

use yii\db\Migration;

class m170530_104346_add_demo_field_to__life_practice__table extends Migration
{
    public function safeUp()
    {
	    $this->execute("
ALTER TABLE `life_practices`
ADD COLUMN `demo`  tinyint NOT NULL DEFAULT 0 AFTER `partner_id`;
");
	    $this->execute("UPDATE `life_practices` SET demo=1 WHERE practice_id IN (1,2)");
    }

    public function safeDown()
    {
    	$this->execute("
ALTER TABLE `life_practices`
DROP COLUMN `demo`;
");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170530_104346_add_demo_field_to__life_practice__table cannot be reverted.\n";

        return false;
    }
    */
}
