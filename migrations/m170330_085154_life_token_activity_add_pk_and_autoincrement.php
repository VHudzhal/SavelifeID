<?php

use yii\db\Migration;

class m170330_085154_life_token_activity_add_pk_and_autoincrement extends Migration
{
    public function safeUp()
    {
	    $this->execute("ALTER TABLE `life_token_activity`
MODIFY COLUMN `activity_id`  int(11) NOT NULL AUTO_INCREMENT COMMENT 'key' FIRST ,
ADD PRIMARY KEY (`activity_id`);
");
    }

    public function safeDown()
    {
    	$this->execute("
ALTER TABLE `life_token_activity`
MODIFY COLUMN `activity_id`  int(11) NOT NULL COMMENT 'key' FIRST ,
DROP PRIMARY KEY;
");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170330_085154_life_token_activity_add_pk_and_autoincrement cannot be reverted.\n";

        return false;
    }
    */
}
