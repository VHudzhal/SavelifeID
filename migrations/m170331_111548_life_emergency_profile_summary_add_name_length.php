<?php

use yii\db\Migration;

class m170331_111548_life_emergency_profile_summary_add_name_length extends Migration
{
    public function safeUp()
    {
	    $this->execute("ALTER TABLE `life_emergency_profile_summary` MODIFY COLUMN `emergency_item`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `internal_id`;");
    }

    public function safeDown()
    {
	    $this->execute("ALTER TABLE `life_emergency_profile_summary` MODIFY COLUMN `emergency_item`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `internal_id`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170331_111548_life_emergency_profile_summary_add_name_length cannot be reverted.\n";

        return false;
    }
    */
}
