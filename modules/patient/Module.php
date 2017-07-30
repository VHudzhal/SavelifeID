<?php

namespace app\modules\patient;

/**
 * patient module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\patient\controllers';

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
