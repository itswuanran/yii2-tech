<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use common\models\Category;
use yii\helpers\ArrayHelper;
use mis\widgets\FileInputWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Oneproduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oneproduct-form">

    <?php $form = ActiveForm::begin();
    $category = $model->category ? $model->category->getCategoryIds() : null;
    $model->categoryid1 = $category ? $category['categoryid1'] : null;
    $model->categoryid2 = $category ? $category['categoryid2'] : null;
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('<div class="label label-warning" style="cursor:pointer">名称示例</div>', [
        'title' => '描述示例',
        'data-container' => 'body',
        'data-toggle' => 'popover',
        'data-content' => '',
        'data-placement' => 'bottom'
    ]) ?>
    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true])->label('商品数量') ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true])->hint('<div class="label label-warning" style="cursor:pointer">名称示例</div>', [
        'title' => '描述示例',
        'data-container' => 'body',
        'data-toggle' => 'popover',
        'data-content' => '',
        'data-placement' => 'bottom'
    ]) ?>

    <?= $form->field($model, 'categoryid1')->widget(Select2::className(), [
        'id' => 'categoryid1',
        'name' => 'categoryid1',
        'data' => ArrayHelper::map(Category::getCategoryByPid(0), 'id', 'name'),
        'options' => [
            'placeholder' => '请选择一级分类',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('一级分类') ?>

    <?= $form->field($model, 'categoryid2')->widget(DepDrop::className(), [
        'type' => DepDrop::TYPE_SELECT2,
        'id' => 'categoryid2',
        'name' => 'categoryid2',
        'data' => $model->categoryid1 ? ArrayHelper::map(Category::getCategoryByPid($model->categoryid1), 'id', 'name') : [],
        'pluginOptions' => [
            'depends' => ['oneproduct-categoryid1'],
            'placeholder' => '请选择二级分类',
            'url' => Url::to(['/category/second'])
        ]
    ])->label('二级分类'); ?>

    <?= $form->field($model, 'categoryid')->widget(DepDrop::className(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => $model->categoryid2 ? ArrayHelper::map(Category::getCategoryByPid($model->categoryid2), 'id', 'name') : [],
        'pluginOptions' => [
            'depends' => ['oneproduct-categoryid1', 'oneproduct-categoryid2'],
            'placeholder' => '请选择三级分类',
            'url' => Url::to(['/category/third'])
        ]
    ])->label('三级分类'); ?>
    <?= $form->field($model, 'headimg')->hiddenInput(['id' => 'headimgid']) ?>
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <?php
            $preview[] = '<img src="' . $model->headimg . '" class="file-preview-image" width="100%"></img>';
            echo FileInputWidget::singleImgInput('headimgid', 1, $preview, 'productImg');
            ?>
        </div>
    </div>
    <?= $form->field($model, 'details')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attr')->textInput(['maxlength' => true]) ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
