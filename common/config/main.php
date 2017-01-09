<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'seotools' => [
            'class' => 'jpunanua\seotools\Component',
        ],
        // ...
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                    ],
                ],
                'seotools' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                    ],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error'],
                    'logVars' => [],
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                    ],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/order.log",
                    'logVars' => [],
                    'categories' => ["order.*"],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/pay.log",
                    'logVars' => [],
                    'categories' => ["pay.*"],
                ],
            ],
        ]
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'seotools' => [
            'class' => 'jpunanua\seotools\Module',
            'roles' => ['@'], // For setting access levels to the seotools interface.
        ]
    ],


];
