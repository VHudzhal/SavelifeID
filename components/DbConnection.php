<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 27.04.17
 * Time: 16:00
 */

namespace app\components;


use yii\db\Connection;

class DbConnection extends Connection {

	public function open(){
		try {
			parent::open();
		} catch(\Exception $e){
			\Yii::$app->isMaintenance = true;
			\Yii::$app->isDbFree = true;
			echo \Yii::$app->runAction('default/site/maintenance');
			\Yii::$app->end();
		}

	}

}