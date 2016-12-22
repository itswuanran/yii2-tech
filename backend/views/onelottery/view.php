<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Onelottery */
?>
<div class="onelottery-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'oneorderid',
            'oneproductid',
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
