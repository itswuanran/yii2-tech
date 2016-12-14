<?php
/**
 * Created by PhpStorm.
 * User: anruence
 * Date: 16/10/27
 * Time: 下午12:30
 */

namespace console\controllers;

use Yii;
use common\models\Order;
use yii\console\Controller;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{

    public function actionMillion()
    {
        $post = Order::find()->where(['id' => 3366])->asArray()->one();
        for ($i = 0; $i < 1000000; $i++) {
            $order = new Order();
            $order->attributes = $post;
            $order->save(false);
            echo $order->id . PHP_EOL;
        }

    }

    public function actionFork()
    {
        for ($i = 0; $i < 6; $i++) {
            $pid = pcntl_fork();
            if (!$pid) {
                Yii::$app->runAction('order/million');
                print "In child $i $pid\n";
                exit($i);
            }
        }
        // 父进程等待所有子线程执行完毕
        while (pcntl_waitpid(0, $status) != -1) {
            $status = pcntl_wexitstatus($status);
            echo "Child $status completed\n";
        }
    }

}