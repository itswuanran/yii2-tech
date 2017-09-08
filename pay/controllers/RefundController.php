<?php
namespace pay\controllers;

use Yii;
use yii\web\Controller;

/**
 * 支付退款
 * Class RefundController
 * @package pay\controllers
 */
class RefundController extends Controller
{
    public function behaviors()
    {
        return [];
    }

    public function actionIndex()
    {
        //TODO
        echo '这里处理各种支付退款的逻辑';
    }
}
