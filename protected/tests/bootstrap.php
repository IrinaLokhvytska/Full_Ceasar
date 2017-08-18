<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$config = dirname(__FILE__) . '/../config/test.php';

require_once dirname(__FILE__) . '/WebTestCase.php';

Yii::createWebApplication($config);
