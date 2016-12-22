<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Oneproterm */
?>
<div class="oneproterm-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'oneproductid',
            'term',
            'price',
            'num',
            'begintime:datetime',
            'endtime:datetime',
            'attr',
            'addtime:datetime',
            'modtime:datetime',
            'status',
        ],
    ]) ?>

</div>
