<?php

$this->title = '检索文章';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?php if ($q) { ?>
                        <h2>
                            <?= count($onearticles) ?> results found for: <span
                                    class="text-navy"><?= htmlspecialchars($q) ?></span>
                        </h2>
                        <small>Request time (0.02 seconds)</small>
                    <?php } ?>

                    <div class="search-form">
                        <form action="/onearticle/search" method="get">
                            <div class="input-group">
                                <input type="text" placeholder="输入关键字..." name="q" class="form-control input-lg">
                                <div class="input-group-btn">
                                    <button class="btn btn-lg btn-primary" type="submit">
                                        搜索
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <?php
                    foreach ($onearticles as $onearticle) {
                        echo '<div class="hr-line-dashed"></div>
                        <div class="search-result">
                            <h3><a href="' . $onearticle->getShortUrl() . '">' . $onearticle->title . '- ' . $onearticle->author . '</a></h3>
                        </div>';
                    }
                    ?>
                    <div class="hr-line-dashed"></div>
                </div>
            </div>
        </div>
    </div>
</div>
