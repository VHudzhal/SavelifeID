<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.fancybox.min.css',
        'css/style.css',

    ];
    public $js = [
	    '//cdn.jsdelivr.net/jquery.cookie/1.4.1/jquery.cookie.min.js',
	    '/js/jquery.fancybox.min.js',
	    '/js/functions.js',
	    '/js/session-countdown.js',
	    '/js/stateful-title.js',
	    '/js/eModal.min.js',
	    '/js/messager.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
	    'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
