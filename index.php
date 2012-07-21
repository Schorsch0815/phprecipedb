<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../yii/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);

require_once('FirePHPCore/FirePHP.class.php');
require_once('FirePHPCore/fb.php');
//
//_start();

//$firephp = FirePHP::getInstance(true);
//$firephp->setEnabled(true);

//FB::log('Log message');
//FB::log('Log message');

//$firephp->log('Plain Message');     // or FB::
//$firephp->info('Info Message');     // or FB::
//$firephp->warn('Warn Message');     // or FB::
//$firephp->error('Error Message');   // or FB::

//xdebug_start_trace(dirname(__FILE__).'/../recipe.trc');

Yii::createWebApplication($config)->run();

//xdebug_stop_trace();
