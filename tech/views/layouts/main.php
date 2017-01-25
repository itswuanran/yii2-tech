<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use tech\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="application-name" content="Yii2技术博客">
    <meta name="description" content="专注于提供Yii2框架的技术文章,提供PHP技术问题的解决方案">
    <meta name="keywords" content="PHP,博客,技术博客,Yii,Yii2,Yii技术博客">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                    </div>
                    <div class="logo-element">Yii2</div>
                </li>
                <li>
                    <a href="/"><i class="fa fa-list"></i> <span class="nav-label">最新文章</span></a>
                </li>
                <li>
                    <a href="/blog/search"><i class="fa fa-search"></i> <span class="nav-label">检索文章</span></a>
                </li>
                <li>
                    <a href="/site/about"><i class="fa fa-users"></i> <span class="nav-label">关于我们</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                    <form role="search" class="navbar-form-custom" action="/blog/search">
                        <div class="form-group">
                            <input type="text" placeholder="检索文章..." class="form-control" name="q" id="top-search">
                        </div>
                    </form>
                </div>
            </nav>
        </div>

        <?= $content ?>

        <div class="footer">
            <div class="pull-right">
                <?= Yii::powered() ?>
            </div>
            <div>
                <strong>Copyright</strong> &copy; <?= date('Y') ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
