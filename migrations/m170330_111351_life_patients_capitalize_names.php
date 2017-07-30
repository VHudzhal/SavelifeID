<?php

use yii\db\Migration;

class m170330_111351_life_patients_capitalize_names extends Migration
{
    public function safeUp()
    {
	    $this->execute("UPDATE life_patients SET first_name = CONCAT(UCASE(LEFT(first_name, 1)), SUBSTRING(first_name, 2));");
	    $this->execute("UPDATE life_patients SET last_name = CONCAT(UCASE(LEFT(last_name, 1)), SUBSTRING(last_name, 2));");
    }

    public function safeDown()
    {
        echo "m170330_111351_life_patients_capitalize_names cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170330_111351_life_patients_capitalize_names cannot be reverted.\n";

        return false;
    }
    */
}
