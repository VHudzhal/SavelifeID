<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mail_queue_and_log`.
 */
class m170629_075557_create_mail_queue_and_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
CREATE TABLE `life_mail_queue` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patients_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `template` varchar(50) NOT NULL,
  `attempts` tinyint(4) NOT NULL DEFAULT 0,
  `send_time` datetime NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `callback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        $this->execute("
CREATE TABLE `life_mail_log` (
  `patients_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `template` varchar(50) NOT NULL,
  `attempts` tinyint(4) NOT NULL,
  `send_time` datetime NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `callback` varchar(200) DEFAULT NULL,
  `sended` tinyint(4) NOT NULL DEFAULT '0',
  `sended_time` datetime DEFAULT NULL,
  `callback_log` varchar(4096) DEFAULT NULL,
  `log` varchar(4096) DEFAULT NULL
) ENGINE=ARCHIVE DEFAULT CHARSET=utf8;");
	    $this->execute("
ALTER TABLE `life_patients`
ADD INDEX `stripe_customer` (`stripe_customer`) ;");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('life_mail_queue');
        $this->dropTable('life_mail_log');
        $this->execute("
ALTER TABLE `life_patients`
DROP INDEX `stripe_customer`;
");
    }
}
