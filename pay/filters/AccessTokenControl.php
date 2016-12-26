<?php

namespace pay\filters;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use common\models\User;

class AccessTokenControl extends AccessControl
{
    public function beforeAction($action)
    {
        foreach ($this->rules as $rule) {
            if (in_array($action->id, $rule->actions) && $rule->allow) {
                return true;
            }
        }
        // TODO
        $user = User::findOne(1);
        Yii::$app->user->identity = $user;
        return true;
    }
}
