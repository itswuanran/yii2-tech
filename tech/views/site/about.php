<?php

use yii\web\View;
use yii\grid\GridView;

$this->title = '关于我们';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/plugins/peity/jquery.peity.min.js');
$js = '
$(function() {
    $("span.pie").peity("pie", {
        fill: [\'#1ab394\', \'#d7d7d7\', \'#ffffff\']
    })

    $(".line").peity("line",{
        fill: \'#1ab394\',
        stroke:\'#169c81\',
    })

    $(".bar").peity("bar", {
        fill: ["#1ab394", "#d7d7d7"]
    })

    $(".bar_dashboard").peity("bar", {
        fill: ["#1ab394", "#d7d7d7"],
        width:100
    })
});
';
$this->registerJs($js, View::POS_END, "locationjs");
?>

<div class="wrapper wrapper-content  animated fadeInRight article">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="pull-right">
                        <button class="btn btn-white btn-xs" type="button">红领巾</button>
                        <button class="btn btn-white btn-xs" type="button">Yii2</button>
                        <button class="btn btn-white btn-xs" type="button">技术</button>
                    </div>
                    <div class="text-center article-title">
                        <h1>
                            红领巾技术博客简介
                        </h1>
                        <span class="text-muted"><i class="fa fa-clock-o"></i> 2016-06-27</span>
                    </div>

                    <h2>博客主旨：</h2>
                    <p>
                        <strong>红领巾</strong><i class="fa fa-copyright" aria-hidden="true"></i> 技术博客旨在通过 <strong>Yii
                            Framework</strong><i class="fa fa-copyright" aria-hidden="true"></i>
                        框架简化PHP开发者的开发流程、提升开发效率。
                        Yii2作为一个成熟且高效的框架，Yii2几乎拥有了整个Web 2.0应用发展的全部特性，更重要的是它具有高度的可重用性和可扩展性。
                        我们认为它更大的作用是作为一个粘合剂，它把数据库、缓存、前端JS、前端CSS、验证器、事件、行为、第三方库等等统统连接起来，让开发变得更加简单，也让代码呈现出美感。
                        在这里，我们会记录一些我们使用Yii2的心得和体会，也会提供一些在更加具体的上下文中我们遇到的问题和解决方案，一来是希望自己能做有积累的事情，二来是希望能帮助更多的人了解Yii2，三来也是提供一些开发上的视野和思路给大家。
                    </p>

                    <br>
                    <h2>贡献成员：</h2>
                    <p>
                        红领巾技术博客文章均贡献自红领巾技术团队，团队成员和文章数量如下：（按照贡献文章数量排序）
                        <?= GridView::widget([
                            "layout" => "{items}",
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                [
                                    'header' => "排名",
                                    'class' => 'yii\grid\SerialColumn',
                                ],
                                [
                                    'attribute' => '姓名',
                                    'value' => function ($model) {
                                        return $model['userid'];
                                    },
                                ],
                                [
                                    'header' => '统计',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return '<span class="line">' . $model['stats'] . '</span>';
                                    },
                                ],
                                [
                                    'attribute' => '文章',
                                    'value' => function ($model) {
                                        return $model['count'] . '篇';
                                    },
                                ],
                            ],
                        ]); ?>
                    </p>
                    <br>
                    <h2>技术追求：</h2>
                    <p>
                        “北冥有鱼，其名为鲲，鲲之大，不知其几千里也。化而为鸟，其名而鹏，鹏之背，不知其几千里也。且夫水之积也不厚，则其负大舟也无力，鲲需要大水助力。风之积也不厚，则其负大翼也无力，鹏需要大风助翔”。在逍遥游中，老庄亦幻亦梦。
                        我们也觉得，Yii2也能成为支撑一个技术团队快速成长的水和风，能让每一个PHP开发者走得更快和更远。</p>

                    <br><br>
                    <h2>团队目标：</h2>
                    <p>我们的目标是成为中国最牛的Yii2技术团队，如果你也是一个喜欢Yii2的程序猴子，欢迎加入我们！
                        心得、体会和简历请寄：anruence@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
