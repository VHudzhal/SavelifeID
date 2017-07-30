<?php

use yii\db\Migration;

class m170315_134652_life_other_physicians_default_empty_values extends Migration
{
    public function up()
    {
	    $this->execute("ALTER TABLE `life_other_physicians`
MODIFY COLUMN `practice_id`  int(11) NOT NULL DEFAULT 0 AFTER `internal_id`,
MODIFY COLUMN `office_phone`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `zip`,
MODIFY COLUMN `cell_phone`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `office_phone`,
MODIFY COLUMN `email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `cell_phone`,
MODIFY COLUMN `main_physician`  tinyint(4) NOT NULL DEFAULT 0 AFTER `email`,
MODIFY COLUMN `allow_alerts`  tinyint(4) NOT NULL DEFAULT 0 AFTER `main_physician`,
MODIFY COLUMN `display`  tinyint(4) NOT NULL DEFAULT 0 AFTER `allow_alerts`;
");
    }

    public function down()
    {
        $this->execute("
ALTER TABLE `life_other_physicians`
MODIFY COLUMN `practice_id`  int(11) NOT NULL AFTER `internal_id`,
MODIFY COLUMN `office_phone`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `zip`,
MODIFY COLUMN `cell_phone`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `office_phone`,
MODIFY COLUMN `email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `cell_phone`,
MODIFY COLUMN `main_physician`  tinyint(4) NOT NULL AFTER `email`,
MODIFY COLUMN `allow_alerts`  tinyint(4) NOT NULL AFTER `main_physician`,
MODIFY COLUMN `display`  tinyint(4) NOT NULL AFTER `allow_alerts`;
        ");
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
