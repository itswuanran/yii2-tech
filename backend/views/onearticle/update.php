<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Onearticle */

$this->title = 'Update Onearticle: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Onearticles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="onearticle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
