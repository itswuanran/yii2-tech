<?php

namespace common\bootstrap;

use yii\base\BootstrapInterface;

class RequestBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // nginx reverse proxy
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP'];
        }
    }
}
