<?php
/**
 * Require helpers
 */
require_once(__DIR__ . '/helpers.php');

/**
 * Load application environment from .env file
 */
//$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
//$dotenv->load();

/**
 * Init application constants
 */
defined('YII_DEBUG') or define('YII_DEBUG', (env('SERVER_ROLE')=='prod') ? false : true);
defined('YII_GII') or define('YII_GII', (env('SERVER_ROLE')=='dev') ? true : false);
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));

