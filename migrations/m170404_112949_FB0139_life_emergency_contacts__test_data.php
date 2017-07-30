<?php

use yii\db\Migration;

class m170404_112949_FB0139_life_emergency_contacts__test_data extends Migration
{
    public function safeUp()
    {
    	$patients = \app\modules\patient\models\Patient::findAll(['email' => ['aw6@uniemr.com', 'joe@gorelickassociates.com', 'bernard.juster@gmail.com', 'gavriel.raanan@gmail.com', 'test12slid@gmail.com', 'konstantin@kashirin.eu', 'johnemr@kashirin.eu', 'johndow@kashirin.eu']]);
    	foreach($patients as $patient){
		    $this->execute("
INSERT INTO life_emergency_contacts
(internal_id, practice_id, contact_name, contact_cell, contact_email, contact_phone, contact_preferred, notify_email, notify_cell, added_by_user, display)
VALUES ('{$patient->internal_id}', 0, 'John Smith', '+111111111', 'foo@fake_mail.com', '+111111111', '', 0, 0, 0, 0)");
	    }

    }

    public function safeDown()
    {
    	$this->execute("DELETE FROM life_emergency_contacts WHERE contact_email='foo@fake_mail.com'");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170404_112949_FB0139_life_emergency_contacts__test_data cannot be reverted.\n";

        return false;
    }
    */
}
