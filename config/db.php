<?php
$sqlite = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'db.sq3';
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'.$sqlite,
//    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
//    'username' => 'root',
//    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
