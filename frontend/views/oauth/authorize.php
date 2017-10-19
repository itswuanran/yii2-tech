<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <form action="/oauth/authorize?<?= http_build_query($params) ?>" method="post">
        <input type="hidden" name="authorize" value="1"/>
        <input type="submit" class="button authorize" value="Yes, I Authorize This Request"/>
    </form>
</div>
