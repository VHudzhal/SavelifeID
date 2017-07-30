<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\modules\patient\models\AssetDeletionQueue;
use yii\console\Controller;
use yii\db\Expression;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionRemoveOldImages()
    {
    	$oldImages = AssetDeletionQueue::find()->where(['<=', 'date_queued', new Expression('(NOW() - INTERVAL 1 HOUR)')])->all();
    	foreach($oldImages as $one){
		    echo('Processing '.$one->s3url.' ... ');
		    if ($one->delete()){
			    echo ('deleted');
		    } else {
			    echo ('ERROR!');
		    }
		    echo "\n";
	    }
	    echo "All done!\n";
    }
}
