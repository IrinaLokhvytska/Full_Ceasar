<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

require_once 'vendor/autoload.php';
$config = dirname(__FILE__) . '/protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

Yii::createWebApplication($config)->run();
