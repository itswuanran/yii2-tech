<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Onearticle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Onearticles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="onearticle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'image',
            'author',
            'author_it',
            'guide_word',
            'wb_img_url:url',
            'content_id',
            'content:ntext',
        ],
    ]) ?>

</div>
