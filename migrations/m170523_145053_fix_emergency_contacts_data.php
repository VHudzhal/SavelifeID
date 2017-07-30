<?php

use yii\db\Migration;

class m170523_145053_fix_emergency_contacts_data extends Migration
{
    public function safeUp()
    {
	    $this->execute("UPDATE life_emergency_contacts SET contact_email='foo@gmail.com' WHERE contact_email='' AND contact_phone=''");
    }

    public function safeDown()
    {
	    $this->execute("UPDATE life_emergency_contacts SET contact_email='' WHERE contact_email='foo@gmail.com'");
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170523_145053_fix_emergency_contacts_data cannot be reverted.\n";

        return false;
    }
    */
}
