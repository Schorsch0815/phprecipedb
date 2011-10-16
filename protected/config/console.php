<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array('basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    
    // autoloading model and component classes
	'import'=>array(
		'application.components.Utilities',
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=phprecipedb',
            'emulatePrepare' => true, 'username' => 'root',
            'password' => 'SQLIsGood4Me', 'charset' => 'utf8',
        ),
        'dbtest' => array('class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=phprecipedb_test',
            'emulatePrepare' => true, 'username' => 'root',
            'password' => 'SQLIsGood4Me', 'charset' => 'utf8',
        ),
    ),
);
