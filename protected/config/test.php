<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
            'components' => array(
                    'fixture' => array(
                            'class' => 'system.test.CDbFixtureManager',
                    ),
                    'db' => array(
                            'connectionString' => 'mysql:host=localhost;dbname=phprecipedb_test',
                            'emulatePrepare' => true, 'username' => 'root',
                            'password' => 'SQLIsGood4Me', 'charset' => 'utf8',
                    ),
                    'log'=>array(
                            'class'=>'CLogRouter',
                            'routes'=>array(
                                    array(
                                            'class'=>'CFileLogRoute',
                                            'levels'=>'error, warning, trace, info',
                                            'categories'=>'application.*',
                                    ),
        
                            ),
                    ),
            ),
    )
);



