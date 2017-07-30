<?php

use yii\db\Migration;

class m170321_105021_life_patients_unique_hash extends Migration
{
    public function up()
    {
	    $this->execute("ALTER TABLE `life_patients` MODIFY COLUMN `internal_id_hash`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `password`;");
	    $this->execute("UPDATE `life_patients` SET `internal_id_hash` = NULL WHERE `internal_id_hash` = '';");
	    $this->execute("ALTER TABLE `life_patients` ADD UNIQUE INDEX (`internal_id_hash`) ;");
    }

    public function down()
    {
	    $this->execute("ALTER TABLE `life_patients` DROP INDEX `internal_id_hash`;");
	    $this->execute("UPDATE `life_patients` SET `internal_id_hash` = '' WHERE `internal_id_hash` IS NULL");
	    $this->execute("ALTER TABLE `life_patients` MODIFY COLUMN `internal_id_hash`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `password`;");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
