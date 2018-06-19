<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Yyd */

$this->title = 'Update Yyd: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Yyds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yyd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
