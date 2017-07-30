<?php

use yii\db\Migration;

/**
 * Handles the creation of table `_life_guest_session_`.
 */
class m170531_143903_create__life_guest_session__table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
CREATE TABLE `life_guest_session` (
  `id` char(40) NOT NULL,
  `key` varchar(255) NOT NULL,
  `expire` int(11) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`,`key`),
  KEY `expire` (`expire`)
);");

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('life_guest_session');
    }
}
