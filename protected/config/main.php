<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//$yiiApp->setTheme('fistful');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array(
		'log',
        'bootstrap', // preload the bootstrap component
        'jqueryui', // preload the bootstrap component
    ),
    'theme' => 'deskmessyii',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.widgets.bootstrap.*',
    ),
    'modules' => array(
    // uncomment the following to enable the Gii tool
    /*
      'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'p',
      // If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>array('127.0.0.1','::1'),
      'generatorPaths'=>array(
      'bootstrap.gii', // since 0.9.1
      ),
      ),
     */
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
        ),
        'jqueryui' => array(
            'class' => 'ext.jqueryui.components.Jqueryui', // assuming you extracted bootstrap under extensions
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName'=>false,
            'rules' => array(
                'site/feed'=>array('site/feed', 'urlSuffix'=>'.xml', 'caseSensitive'=>false),
                'site/feed/<id:\d+>'=>'site/feed',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost:3306;dbname=coderblog', //;unix_socket=/tmp/mysql.sock',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
//               'bootstrap'=>array(
//                'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
//            ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'talhaakkas@gmail.com',
    ),
);