<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Order;
use frontend\forms\CreateOneOrderForm;

class OrderController extends Controller
{
    public function behaviors()
    {
        return [];
        //TODO
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => OneAccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'list', 'info', 'create'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ]);
    }

    /**
     * 一元夺宝下单
     * @return array|String
     */
    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        $model = new CreateOneOrderForm();
        //TODO
    }

    /**
     * 一元夺宝订单列表
     * @return array
     */
    public function actionList()
    {
        $user = Yii::$app->user->identity;
        $data = [];
        $orders = Order::find()
            ->where(['userid' => $user->id])
            ->all();
        foreach ($orders as $order) {
            $data[] = $order->processInfo();
        }
        //TODO
    }

    /**
     * 订单详情
     * @return array
     */
    public function actionInfo()
    {
        $user = Yii::$app->user->identity;
        //TODO
    }
}

