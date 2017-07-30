<?php

use yii\db\Migration;

class m170405_105015_fix_null_text_on__life_patients extends Migration
{
    public function safeUp()
    {
	    $this->execute("UPDATE life_patients SET medical_history_text='' WHERE medical_history_text = 'NULL'");
	    $this->execute("UPDATE life_patients SET surgical_history_text='' WHERE surgical_history_text = 'NULL'");
    }

    public function safeDown()
    {
        echo "m170405_105015_fix_null_text_on__life_patients cannot be reverted.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170405_105015_fix_null_text_on__life_patients cannot be reverted.\n";

        return false;
    }
    */
}
