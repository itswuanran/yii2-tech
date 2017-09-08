<?php

use yii\helpers\Html;

$this->title = '修改文章: ' . ' ' . $model->title;
?>
<div class="blog-update">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
