<?php

use yii\db\Migration;

/**
 * Handles the creation of table `life_asset_deletion_queue`.
 */
class m170510_110557_create_life_asset_deletion_queue_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
    	$this->execute("
CREATE TABLE `life_asset_deletion_queue` (
  `s3url` varchar(200) NOT NULL,
  `date_queued` datetime NOT NULL,
  UNIQUE KEY `s3url` (`s3url`)
);");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
	    $this->execute("DROP TABLE `life_asset_deletion_queue`;");
    }
}
