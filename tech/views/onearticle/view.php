<?php

$this->title = '一个';
$this->params['breadcrumbs'][] = $this->title;
nezhelskoy\highlight\HighlightAsset::register($this);
?>

<div class="wrapper wrapper-content animated fadeInRight article">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="pull-right">
                        <button class="btn btn-white btn-xs" type="button">Model</button>
                        <button class="btn btn-white btn-xs" type="button">Publishing</button>
                        <button class="btn btn-white btn-xs" type="button">Modern</button>
                    </div>
                    <div class="text-center article-title">
                        <h1>
                            <?= $onearticle->title ?>
                        </h1>
                        <span class="text-muted">
                            <i class="fa fa-clock-o"></i> <?= date('Y-m-d') ?> <?= $onearticle->author ?>
                        </span>
                    </div>
                    <?= $onearticle->content ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tags:</h5>
                            <button class="btn btn-primary btn-xs" type="button">One</button>
                            <button class="btn btn-white btn-xs" type="button">一个</button>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-right">
                                <h5>Stats:</h5>
                                <i class="fa fa-eye"> </i> <?= 1 ?>次查看
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
