<?php

use yii\db\Migration;

class m170602_133913_add_support_request_field_to__life_patients__table extends Migration
{
    public function safeUp()
    {
	    $this->execute("ALTER TABLE `life_patients`
ADD COLUMN `support_request`  tinyint NOT NULL DEFAULT 1 AFTER `completed_registration_date`;
");
    }

    public function safeDown()
    {
	    $this->execute("ALTER TABLE `life_patients`
DROP COLUMN `support_request`;
");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170602_133913_add_support_request_field_to__life_patients__table cannot be reverted.\n";

        return false;
    }
    */
}
