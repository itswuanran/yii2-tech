<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lottery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lottery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oneorderid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oneproductid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lotteryno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'isused')->textInput() ?>

    <?= $form->field($model, 'islucky')->textInput() ?>

    <?= $form->field($model, 'attr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addtime')->textInput() ?>

    <?= $form->field($model, 'modtime')->textInput() ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
