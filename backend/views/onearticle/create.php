<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Onearticle */

$this->title = 'Create Onearticle';
$this->params['breadcrumbs'][] = ['label' => 'Onearticles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="onearticle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
