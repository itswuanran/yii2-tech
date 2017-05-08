<?php

$this->title = '屠龙的勇士';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content  animated fadeInRight blog">
    <div class="row">
        <?php
        for ($j = 0; $j < 3; $j++) {
            echo '<div class="col-lg-4">';
            for ($i = $j; $i < count($blogs); $i += 3) {
                if (!isset($blogs[$i])) {
                    continue;
                }
                $blog = $blogs[$i];
                echo '<div class="ibox">
                    <div class="ibox-content">
                        <a href="' . $blog->getShortUrl() . '" class="btn-link">
                            <h2 style="height: 1em; line-height: 1em; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; width: 100%;">' . $blog->title . '</h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong>' . $blog->getAuthor() . '</strong>
                            <span class="text-muted"><i class="fa fa-clock-o"></i> ' . date('Y-m-d', $blog->addtime) . '</span>
                        </div>
                        <div style="height: 1.5em; line-height: 1em; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; width: 100%;">
                        ' . $blog->getHtmlSummary() . '
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-primary btn-xs" type="button">Yii2</button>
                                <button class="btn btn-white btn-xs" type="button">PHP</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <i class="fa fa-eye"> </i> ' . $blog->views . '次查看
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>
