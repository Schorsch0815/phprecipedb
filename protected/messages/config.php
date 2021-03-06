<?php
// This is hopefully a config array for the messages
return array(
        'sourcePath' => dirname(__FILE__). DIRECTORY_SEPARATOR. '..' ,  //root dir of all source
        'messagePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR . 'messages',  //root dir of message translations
        'languages'  => array('de'),  //array of lang codes to translate to, e.g. es_mx
        'fileTypes' => array('php','js',), //array of extensions no dot all others excluded
        'exclude' => array('.git',
                           '/messages',
                           '/modules',
                           '/extensions/alphapager'),  //list of paths or files to exclude
        'overwrite' => true,
        'translator' => 'Yii::t',  //this is the default but lets be complete
        'sort' => 'new',
);