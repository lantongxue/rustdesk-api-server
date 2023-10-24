<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            //'class' => 'yii\web\Request',
            'cookieValidationKey' => 'EQcaAW_icTZNHPaMiYq1xtPYecQROY2C',
            'enableCsrfValidation' => false
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ]
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'verb' => 'POST',
                    'pattern' => '/api/login',
                    'route' => 'login/index'
                ],
                [
                    'verb' => 'POST',
                    'pattern' => '/api/logout',
                    'route' => 'login/logout'
                ],
                [
                    'verb' => 'GET',
                    'pattern' => '/api/login-options',
                    'route' => 'login/options'
                ],
                [
                    'verb' => 'POST',
                    'pattern' => '/api/currentUser',
                    'route' => 'user/index'
                ],
                [
                    'verb' => 'GET',
                    'pattern' => '/api/users',
                    'route' => 'user/users'
                ],
                [
                    'verb' => 'GET',
                    'pattern' => '/api/peers',
                    'route' => 'peer/peers'
                ],
                [
                    'verb' => 'GET',
                    'pattern' => '/api/ab',
                    'route' => 'address-book/pull'
                ],
                [
                    'verb' => 'POST',
                    'pattern' => '/api/ab',
                    'route' => 'address-book/push'
                ],
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
