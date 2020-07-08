<?php

use sizeg\jwt\Jwt;

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
            'cookieValidationKey' => '6_alL7exhqoA2c-F28nc_x-NB8OWFG3L',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                'admin' => 'admin/index',
                'admin/authors' => 'authors/index',
                'admin/authors/create' => 'authors/create',
                'admin/authors/<id:\d+>' => 'authors/view',
                'admin/authors/update/<id:\d+>' => 'authors/update',
                'admin/authors/delete/<id:\d+>' => 'authors/delete',
                'admin/books' => 'books/index',
                'admin/books/create' => 'books/create',
                'admin/books/<id:\d+>' => 'books/view',
                'admin/books/update/<id:\d+>' => 'books/update',
                'admin/books/delete/<id:\d+>' => 'books/delete',
                'admin/review/create' => 'review/create',
                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'api/login' => 'api/login',
                'api/generate' => 'api/generate',
                'api/retrieve' => 'api/retrieve'
            ],
        ],
        'jwt' => [
            'class' => Jwt::class,
            'key'   => 'secret',
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
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
