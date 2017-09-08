<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$urlMap = [
];
return [
    'id' => 'app-pay',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => '/site/index',
    'controllerNamespace' => 'pay\controllers',
    'modules' => [
    ],
    'components' => [
        'user' => [
            'identityClass' => 'pay\models\User',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $urlMap
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => [],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/notify.log",
                    'logVars' => [],
                    'categories' => ["notify.*"],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/wxpay.log",
                    'logVars' => [],
                    'categories' => ["wxpay.*"],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/alipay.log",
                    'logVars' => [],
                    'categories' => ["alipay.*"],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/verify.log",
                    'logVars' => [],
                    'categories' => ["verify.*"],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info'],
                    'logFile' => "@app/runtime/logs/refund.log",
                    'logVars' => [],
                    'categories' => ["refund.*"],
                ],
            ],
        ],
        'errorHandler' => [
        ],
    ],
    'params' => $params,
];
