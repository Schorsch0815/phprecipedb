<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array('basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'phprecipeDB',
        // preloading 'log' component
        'preload' => array('log',
//                'foundation', // preload the foundation component
        ),
        // autoloading model and component classes
        'import' => array('application.models.*', 'application.components.*',
                'application.extensions.alphapager.*',
        ),
        'modules' => array(
                // uncomment the following to enable the Gii tool
                'gii' => array('class' => 'system.gii.GiiModule',
                        'password' => 'go4yii',
                        // If removed, Gii defaults to localhost only. Edit carefully to taste.
                        'ipFilters' => array('127.0.0.1', '::1'),
                ),
                'userGroups'=>array(
                        'accessCode'=>'123456',
                )
        ),
        // application components
        'components' => array(
                'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'class'=>'userGroups.components.WebUserGroups',
                ),
//                'foundation' => array("class" => "ext.foundation.components.Foundation"),
                // uncomment the following to enable URLs in path-format

                'urlManager'=>array(
                    'urlFormat'=>'path',
                    'rules'=>array(
                      '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                      '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                      '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    ),
                    'showScriptName'=>false,
                ),
                /*
                'db'=>array(
                    'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
                ),
                 */
                // uncomment the following to use a MySQL database
                'db' => array(
                        'connectionString' => 'mysql:host=localhost;dbname=phprecipedb',
                        'emulatePrepare' => true, 'username' => 'root',
                        'password' => 'SQLIsGood4Me', 'charset' => 'utf8',
                ),
                'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction' => 'site/error',
                ),
                'log' => array('class' => 'CLogRouter',
                        'routes' => array(
                                array('class' => 'CFileLogRoute',
                                        'levels' => 'error, warning, info',
                                ),
                                // uncomment the following to show log messages on web pages
                                array('class' => 'CWebLogRoute',
                                        'levels' => 'error, warning, info',
                                ),
                        ),
                ),
        ),
        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params' => array(
        // this is used in contact page
        'adminEmail' => 'jochen@workspace.local',
        ),
);
