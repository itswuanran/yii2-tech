<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Proterm */
?>
<div class="proterm-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'productid',
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
