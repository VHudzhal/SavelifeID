<?php

use yii\db\Migration;

class m170405_122522_life_patiens__email_can_be_empty extends Migration
{
    public function safeUp()
    {
	    $this->execute("ALTER TABLE `life_patients`
MODIFY COLUMN `email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `status`;
");
    }

    public function safeDown()
    {
	    $this->execute("ALTER TABLE `life_patients`
MODIFY COLUMN `email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `status`;
");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170405_122522_life_patiens__email_can_be_empty cannot be reverted.\n";

        return false;
    }
    */
}
