<?php

use yii\db\Migration;

class m170531_111108_add_unique_index_to__practice__table extends Migration
{
    public function safeUp()
    {
	    $this->execute("
ALTER TABLE `life_practices`
ADD UNIQUE INDEX (`auth_user`) ,
ADD UNIQUE INDEX (`practice_umr_id`) ;");
    }

    public function safeDown()
    {
	    $this->execute("
ALTER TABLE `life_practices`
DROP INDEX `auth_user`,
DROP INDEX `practice_umr_id`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170531_111108_add_unique_index_to__practice__table cannot be reverted.\n";

        return false;
    }
    */
}
