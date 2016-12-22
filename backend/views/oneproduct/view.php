<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Oneproduct */
?>
<div class="oneproduct-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'nickname',
            'desc',
            'categoryid',
            'headimg',
            'details',
            'status',
            'price',
            'attr',
            'addtime:datetime',
            'modtime:datetime',
        ],
    ]) ?>

</div>
