<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('首页', ['index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确认要删除？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'content',
                'value' => \yii\helpers\Markdown::process($model->content),
                'format' => 'raw'
            ],
            'addtime:datetime',
            'modtime:datetime',
        ],
    ]) ?>

</div>
