<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 27.04.17
 * Time: 17:00
 */

namespace app\components;


class Application extends \yii\web\Application {
	public $isMaintenance = false;
	public $isDbFree = false;
}