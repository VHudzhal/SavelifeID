<?php

use yii\db\Migration;

class m170622_104929_create_table__log_webhooks extends Migration
{
    public function safeUp()
    {
	    $this->execute("
CREATE TABLE `life_log_webhooks` (
  `stripe_event_id` char(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event` text NOT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `patients_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stripe_event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
    }

    public function safeDown()
    {
        $this->execute("DROP TABLE `life_log_webhooks`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170622_104929_create_table__log_webhooks cannot be reverted.\n";

        return false;
    }
    */
}
