<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tech',
            'username' => 'tech',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mutex' => [
            'class' => 'yii\mutex\MysqlMutex',
        ],
    ],
];
