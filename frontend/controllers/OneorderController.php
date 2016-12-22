<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Oneorder;
use frontend\forms\CreateOneOrderForm;

class OneorderController extends Controller
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
        $oneorders = Oneorder::find()
            ->where(['userid' => $user->id])
            ->all();
        foreach ($oneorders as $oneorder) {
            $data[] = $oneorder->processInfo();
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

