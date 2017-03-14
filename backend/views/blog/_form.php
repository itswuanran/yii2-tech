<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use anruence\editormd\EditorMd;

?>

<div class='blog-form'>
    <?php $form = ActiveForm::begin([
    ]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content')->widget(EditorMd::className(), [
            'options' => [
                'height' => '640',
//                'previewTheme' => 'dark',
//                'editorTheme' => 'pastel-on-dark',
                'markdown' => '',
                'codeFold' => true,
                'syncScrolling' => true,
                'saveHTMLToTextarea' => true,    // 保存 HTML 到 Textarea
                'searchReplace' => true,
//                'watch' => false,                // 关闭实时预览
                'htmlDecode' => 'style,script,iframe|on*',            // 开启 HTML 标签解析，为了安全性，默认不开启
//                'toolbar' => false,             //关闭工具栏
                'previewCodeHighlight' => false, // 关闭预览 HTML 的代码块高亮，默认开启
                'emoji' => true,
                'taskList' => true,
                'tocm' => true,         // Using [TOCM]
                'tex' => true,                   // 开启科学公式TeX语言支持，默认关闭
                'flowChart' => true,             // 开启流程图支持，默认关闭
                'sequenceDiagram' => true,       // 开启时序/序列图支持，默认关闭,
//                'dialogLockScreen' => false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
//                'dialogShowMask' => false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
//                'dialogDraggable' => false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
//                'dialogMaskOpacity' => 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
//                'dialogMaskBgColor' => '#000', // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                'imageUpload' => true,
                'imageFormats' => ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'],
                //TODO 图片上传地址
                'imageUploadURL' => '/blog/upload',
            ]
        ]
    ) ?>

    <div class='form-group field-blog-submit'>
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


