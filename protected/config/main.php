<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Caesar',
    // preloading 'log' component
    'preload' => ['log'],
    // autoloading model and component classes
    'import' => [
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
    ],
    'modules' => [
        // uncomment the following to enable the Gii tool
        /*
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'Enter Your Password Here',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        */
    ],
    // application components
    'components' => [
        'urlManager' => [
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<locations:' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<group_id:' => '<controller>/<action>',
            ],
        ],
        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ],
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG
                ? null
                : 'site/error',
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ],
        ],
        'Group' => ['class' => 'GroupComponent'],
        'Location' => ['class' => 'LocationComponent'],
        'Direction' => ['class' => 'DirectionComponent'],
        'Teacher' => ['class' => 'TeacherComponent'],
        'Student' => ['class' => 'StudentComponent'],
    ],
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => [
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ],
];
