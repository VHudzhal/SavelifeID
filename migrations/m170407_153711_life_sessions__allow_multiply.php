<?php

use yii\db\Migration;

class m170407_153711_life_sessions__allow_multiply extends Migration
{
    public function safeUp()
    {
	    $this->execute("
ALTER TABLE `life_sessions`
DROP PRIMARY KEY,
ADD UNIQUE INDEX (`patient_id`, `session_id`) ;
		");
    }

    public function safeDown()
    {
	    $this->execute("
ALTER TABLE `life_sessions`
ADD PRIMARY KEY (`patient_id`),
DROP INDEX `patient_id`;
		");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170407_153711_life_sessions__allow_multiply cannot be reverted.\n";

        return false;
    }
    */
}
