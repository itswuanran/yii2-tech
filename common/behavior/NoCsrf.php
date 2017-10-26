<?php

namespace common\behavior;

use yii\base\Behavior;
use yii\web\Controller;

/**
 * 这个类的作用是对controller的局部action禁用csrf限制
 * 你不能在简单的在action内部设置enableCsrfValidation=false，这里牵扯到前后执行的问题。
 *```php
 * 'csrf' => [
 * 'class' => NoCsrf::className(),
 * 'controller' => $this,
 * 'actions' => [
 * 'action-name'
 * ]
 * ]
 *```
 */
class NoCsrf extends Behavior
{
    public $actions = [];
    public $controller;

    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    public function beforeAction($event)
    {
        $action = $event->action->id;
        if (in_array($action, $this->actions)) {
            $this->controller->enableCsrfValidation = false;
        }
    }
}