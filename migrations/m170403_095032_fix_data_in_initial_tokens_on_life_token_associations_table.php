<?php

use yii\db\Migration;

class m170403_095032_fix_data_in_initial_tokens_on_life_token_associations_table extends Migration
{
    public function safeUp()
    {
	    $this->execute("UPDATE life_token_associations SET token_id=token_slid, token_slid=patient_internal_id, description='initial token' WHERE description = 'initial patients'");
    }

    public function safeDown()
    {
	    $this->execute("UPDATE life_token_associations SET token_id=token_slid, token_slid=token_id, description='initial patients' WHERE description = 'initial token'");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170403_095032_fix_data_in_initial_tokens_on_life_token_associations_table cannot be reverted.\n";

        return false;
    }
    */
}
