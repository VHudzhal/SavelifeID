<?php

use yii\db\Migration;

class m170529_114803_add_reset_password_link_expiry_date_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('life_patients', 'link_exp_date', $this->dateTime());

    }

    public function safeDown()
    {
        $this->dropColumn('life_patients', 'link_exp_date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170529_114803_add_reset_password_link_expire_date_column cannot be reverted.\n";

        return false;
    }
    */
}
