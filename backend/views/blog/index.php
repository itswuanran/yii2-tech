<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\helpers\StringHelper;

$this->title = '博客管理';
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'responsiveWrap' => false,
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'content',
                'value' => function ($model) {
                    return StringHelper::truncateMsg($model->content, 50);  //显示省略号
                }
            ],
            'addtime:datetime',
            'modtime:datetime',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{create}{view}{update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>查看', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-default'
                        ]);
                    },
                    'create' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>创建', $url, [
                            'title' => Yii::t('yii', 'Create'),
                            'class' => 'btn btn-success'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class=" glyphicon glyphicon-pencil"></span>更新', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'btn btn-primary'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
