<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Yyd */

$this->title = 'Create Yyd';
$this->params['breadcrumbs'][] = ['label' => 'Yyds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yyd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
