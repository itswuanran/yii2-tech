<?php

use yii\helpers\Html;
use common\models\Proterm;

return [
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
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
        'attribute' => 'price',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'num',
    ],
    "begintime:datetime",
    "endtime:datetime",
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'value' => function ($model) {
            $str = $model->getStatusDesc();
            if ($model->status == Proterm::STATUS_AWARDED) {
                return "<div class='label-info'>$str</div>";
            } else if ($model->status == Proterm::STATUS_OFFLINE) {
                return "<div class='label-warning'>$str</div>";
            } else {
                return "<div class='label-success'>$str</div>";
            }
        },
        'format' => 'raw'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'width' => '200px',
        'template' => '<div class="btn-group">{view}{award}</div>',
        'header' => "操作",
        'buttons' => [
            'view' => function ($url, $model, $key) {
                return Html::a("查看", ["view", "id" => $model->id], [
                    'class' => 'btn btn-info',
                    'role' => 'modal-remote',
                    'data-toggle' => 'tooltip'
                ]);
            },
            'award' => function ($url, $model, $key) {
                if ($model->status == \common\models\Proterm::STATUS_AWARDED) {
                    return Html::button('开奖', ['class' => 'btn btn-danger', 'disabled' => 'disabled']);
                }
                return Html::a("开奖", ["award", "id" => $model->id], [
                    'class' => 'btn btn-danger',
                    'role' => 'modal-remote',
                    'data-toggle' => 'tooltip',
                    'data-confirm' => false,
                    'data-method' => false,// for overide yii data api
                    'data-request-method' => 'post',
                    'data-confirm-title' => '温馨提示',
                    'data-confirm-message' => '您确定要开奖吗？'
                ]);
            },
        ],
    ],

];   
