<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'orderid',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'productid',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'term',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'userid',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'lotteryno',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'isused',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'islucky',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'attr',
    ],
    "addtime:datetime",
    "modtime:datetime",
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'width' => '200px',
        'template' => '<div class="btn-group">{view}</div>',
        'header' => "操作",
        'buttons' => [
            'view' => function ($url, $model, $key) {
                return Html::a("查看", ["view", "id" => $model->id], [
                    'class' => 'btn btn-info',
                    'role' => 'modal-remote',
                    'data-toggle' => 'tooltip'
                ]);
            },
        ],
    ],

];   
