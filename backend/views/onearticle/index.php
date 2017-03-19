<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Onearticles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="onearticle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Onearticle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'author',
            'author_it',
            // 'content:ntext',
            // 'content_id',
            'wb_img_url:url',
            'guide_word',
            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>
