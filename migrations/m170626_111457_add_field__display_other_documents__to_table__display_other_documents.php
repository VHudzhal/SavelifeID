<?php

use yii\db\Migration;

class m170626_111457_add_field__display_other_documents__to_table__display_other_documents extends Migration
{
    public function safeUp()
    {
	    $this->execute("
ALTER TABLE `life_patients_log`
ADD COLUMN `display_medical_history`  tinyint(4) NULL AFTER `surgical_history_text`;");
    }

    public function safeDown()
    {
    	$this->execute('
ALTER TABLE `life_patients_log` DROP COLUMN `display_medical_history`;');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170626_111457_add_field__display_other_documents__to_table__display_other_documents cannot be reverted.\n";

        return false;
    }
    */
}
