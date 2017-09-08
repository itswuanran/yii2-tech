<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lottery */
?>
<div class="lottery-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'orderid',
            'productid',
            'term',
            'userid',
            'lotteryno',
            'status',
            'isused',
            'islucky',
            'attr',
            'addtime:datetime',
            'modtime:datetime',
        ],
    ]) ?>

</div>
