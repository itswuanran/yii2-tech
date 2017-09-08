<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tech',
            'username' => 'homestead',
            'password' => 'secret',
            'charset' => 'utf8',
        ],
        'mutex' => [
            'class' => 'yii\mutex\MysqlMutex',
        ],
    ],
];
