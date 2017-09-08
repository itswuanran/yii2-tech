<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Product;

return [
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nickname',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'desc',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'num',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'categoryid',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'headimg',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'details',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'price',
    ],
    "addtime:datetime",
    "modtime:datetime",
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'width' => '200px',
        'template' => '<div class="btn-group">{update}{view}{online}</div>',
        'header' => "操作",
        'buttons' => [
            'view' => function ($url, $model, $key) {
                return Html::a("查看", ["view", "id" => $model->id], [
                    'class' => 'btn btn-info',
                    'role' => 'modal-remote',
                    'data-toggle' => 'tooltip'
                ]);
            },
            'update' => function ($url, $model, $key) {
                return Html::a("修改", ["update", "id" => $model->id], [
                    'class' => 'btn btn-primary',
                    'role' => 'modal-remote',
                    'data-toggle' => 'tooltip'
                ]);
            },
        ],
    ],

];   
