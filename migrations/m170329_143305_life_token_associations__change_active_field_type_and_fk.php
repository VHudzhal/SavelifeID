<?php

use yii\db\Migration;

class m170329_143305_life_token_associations__change_active_field_type_and_fk extends Migration
{
    public function safeUp()
    {
	    $this->execute("ALTER TABLE `life_token_associations` MODIFY COLUMN `active`  int(4) NOT NULL COMMENT 'fk for life_token_action_lookup table' AFTER `enrollment`;");
	    $this->execute("ALTER TABLE `life_token_action_lookup` ADD INDEX (`action_id`);");
	    $this->execute("ALTER TABLE `life_token_associations` ADD FOREIGN KEY (`active`) REFERENCES `life_token_action_lookup` (`action_id`) ON DELETE RESTRICT ON UPDATE CASCADE;");
    }

    public function safeDown()
    {
	    $this->execute("ALTER TABLE `life_token_associations` DROP INDEX `active`;");
	    $this->execute("ALTER TABLE `life_token_associations` DROP FOREIGN KEY `life_token_associations_ibfk_1`;");
	    $this->execute("ALTER TABLE `life_token_associations` MODIFY COLUMN `active`  int(11) NOT NULL COMMENT 'set to zero if the token cannot be used to return medical data (inactive)' AFTER `enrollment`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170329_143305_life_token_associations__change_active_field_type_and_fk cannot be reverted.\n";

        return false;
    }
    */
}
