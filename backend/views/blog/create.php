<?php
use yii\helpers\Html;

$this->title = '新建文章';
?>
<div class="blog-create">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
