<?php

$this->title = '一个';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        'author',
        'author_it',
        'guide_word',
        'wb_img_url:url',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

