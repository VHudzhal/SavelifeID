<?php

namespace app\modules\api;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
	public function init()
	{
		parent::init();
		// initialize the module with the configuration loaded from config.php
		\Yii::configure($this, require(__DIR__ . '/config.php'));
	}
}
