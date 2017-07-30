<?php

use yii\db\Migration;

class m170317_125133_life_emergency_contacts__add_default_value extends Migration
{
    public function up()
    {
	    $this->execute("
ALTER TABLE `life_emergency_contacts`
MODIFY COLUMN `practice_id`  int(11) NOT NULL DEFAULT 0 AFTER `internal_id`,
MODIFY COLUMN `contact_cell`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `contact_name`,
MODIFY COLUMN `contact_email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `contact_cell`,
MODIFY COLUMN `contact_phone`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `contact_email`,
MODIFY COLUMN `contact_preferred`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `contact_phone`,
MODIFY COLUMN `notify_email`  tinyint(4) NOT NULL DEFAULT 0 AFTER `contact_preferred`,
MODIFY COLUMN `notify_cell`  tinyint(4) NOT NULL DEFAULT 0 AFTER `notify_email`,
MODIFY COLUMN `added_by_user`  tinyint(4) NOT NULL DEFAULT 0 AFTER `notify_cell`,
MODIFY COLUMN `display`  tinyint(4) NOT NULL DEFAULT 0 AFTER `added_by_user`;
	    ");
    }

    public function down()
    {
	    $this->execute("
ALTER TABLE `life_emergency_contacts`
MODIFY COLUMN `practice_id`  int(11) NOT NULL AFTER `internal_id`,
MODIFY COLUMN `contact_cell`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `contact_name`,
MODIFY COLUMN `contact_email`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `contact_cell`,
MODIFY COLUMN `contact_phone`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `contact_email`,
MODIFY COLUMN `contact_preferred`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `contact_phone`,
MODIFY COLUMN `notify_email`  tinyint(4) NOT NULL AFTER `contact_preferred`,
MODIFY COLUMN `notify_cell`  tinyint(4) NOT NULL AFTER `notify_email`,
MODIFY COLUMN `added_by_user`  tinyint(4) NOT NULL AFTER `notify_cell`,
MODIFY COLUMN `display`  tinyint(4) NOT NULL AFTER `added_by_user`;
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
