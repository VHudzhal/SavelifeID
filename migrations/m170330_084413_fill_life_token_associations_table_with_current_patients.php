<?php

use yii\db\Migration;

class m170330_084413_fill_life_token_associations_table_with_current_patients extends Migration
{
    public function safeUp()
    {
	    $this->execute("
INSERT INTO life_token_associations (token_id, token_slid, patient_id, patient_internal_id, active, enrollment, token_type, description)
SELECT 
internal_id, md5(internal_id), patients_id, internal_id, 3, 1, 1, 'initial patients'
FROM life_patients");
    }

    public function safeDown()
    {
    	$this->execute("DELETE FROM life_token_associations WHERE description = 'initial patients'");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170330_084413_fill_life_token_associations_table_with_current_patients cannot be reverted.\n";

        return false;
    }
    */
}
