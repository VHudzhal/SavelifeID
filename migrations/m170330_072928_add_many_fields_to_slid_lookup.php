<?php

use yii\db\Migration;
use app\components\MigrationHelper;

class m170330_072928_add_many_fields_to_slid_lookup extends Migration
{
    public function up()
    {
	    if (!MigrationHelper::fieldExists('life_slid_lookup','slid_hash')){
		    $this->execute("ALTER TABLE `life_slid_lookup` ADD COLUMN `slid_hash` varchar(255) DEFAULT NULL AFTER `slid`");
	    }
	    if (!MigrationHelper::fieldExists('life_slid_lookup','printed')){
		    $this->execute("ALTER TABLE `life_slid_lookup` ADD       COLUMN `printed` tinyint(4) NOT NULL DEFAULT '0' AFTER `in_use`");
	    }
	    if (!MigrationHelper::fieldExists('life_slid_lookup','type')){
		    $this->execute("ALTER TABLE `life_slid_lookup` ADD       COLUMN `type` tinyint(4) NOT NULL DEFAULT '0' AFTER `printed`");
	    }
	    if (!MigrationHelper::fieldExists('life_slid_lookup','url')){
		    $this->execute("ALTER TABLE `life_slid_lookup` ADD       COLUMN `url` varchar(100) DEFAULT NULL AFTER `type`");
	    }
	    if (!MigrationHelper::fieldExists('life_slid_lookup','salt')){
		    $this->execute("ALTER TABLE `life_slid_lookup` ADD       COLUMN `salt` varchar(100) DEFAULT NULL AFTER `url`");
	    }
	    $this->execute("UPDATE `life_slid_lookup` SET url=CONCAT('https://google.com/?q=',row_id) WHERE url='' ");
	    $this->execute("
ALTER TABLE `life_slid_lookup`
  MODIFY    COLUMN `in_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `slid_hash`,
  ADD UNIQUE KEY `unique_hash` (`slid_hash`),
  ADD UNIQUE KEY `unique url` (`url`);"); 
    }

    public function down()
    {
	    $this->execute("
ALTER TABLE `life_slid_lookup`
  MODIFY COLUMN `in_use` tinyint(4) NOT NULL,
  DROP COLUMN `slid_hash`,
  DROP COLUMN `printed`,
  DROP COLUMN `type`,
  DROP COLUMN `url`,
  DROP COLUMN `salt`,   
  DROP KEY `unique_hash`,
  DROP KEY `unique url`;"); 
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170330_072928_add_many_fields_to_slid_lookup cannot be reverted.\n";

        return false;
    }
    */
}
