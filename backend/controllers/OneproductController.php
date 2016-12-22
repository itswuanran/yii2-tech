<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\models\Oneproterm;
use common\models\Oneproduct;
use common\models\Onelottery;
use backend\searchs\OneproductSearch;

/**
 * OneproductController implements the CRUD actions for Oneproduct model.
 */
class OneproductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 列出所有的Oneproduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OneproductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * 展示单个Oneproduct model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title' => "Oneproduct #" . $id,
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
        ];
    }

    /**
     * 创建一个新的Oneproduct model.
     * 为了ajax使用，返回json
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Oneproduct();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load($request->post()) && $model->save()) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "创建Oneproduct",
                'content' => '<span class="text-success">创建成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('创建更多', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "创建Oneproduct",
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * 修改Oneproduct model.
     * ajax请求返回json数据
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load($request->post()) && $model->save()) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "Oneproduct #" . $id,
                'content' => '<span class="text-success">修改成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "Update Oneproduct #" . $id,
                'content' => $this->renderAjax('update', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * @return mixed
     */
    public function actionOffline($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $oneproduct = Oneproduct::findOne($id);
        if (!$oneproduct) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "下线 #" . $id,
                'content' => '<span class="text-error">商品不存在</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        $oldoneproterm = Oneproterm::find()->where(['oneproductid' => $id, 'status' => Oneproterm::STATUS_ONLINE])->orderBy(['id' => SORT_DESC])->one();
        if (!$oldoneproterm) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "下线 #" . $id,
                'content' => '<span class="text-error">本期商品未上线</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        $oldoneproterm->status = Oneproterm::STATUS_OFFLINE;
        $oldoneproterm->endtime = time();
        $oldoneproterm->save(false);
        // 期数id置0
        $oneproduct->oneprotermid = 0;
        $oneproduct->status = Oneproduct::STATUS_OFFLINE;
        $oneproduct->save(false);
        return [
            'forceReload' => '#crud-datatable-pjax',
            'title' => "上线 #" . $id,
            'content' => '<span class="text-success">商品下线成功</span>',
            'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
        ];
    }

    /**
     * @return mixed
     */
    public function actionOnline($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $oneproduct = Oneproduct::findOne($id);
        if (!$oneproduct) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "上线 #" . $id,
                'content' => '<span class="text-error">商品不存在</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }

        $oldoneproterm = Oneproterm::find()->where(['oneproductid' => $id])->orderBy(['id' => SORT_DESC])->one();
        $transaction = Yii::$app->db->beginTransaction();
        $oneproterm = new Oneproterm();
        $oneproterm->oneproductid = $id;
        $oneproterm->term = $oldoneproterm ? ($oldoneproterm->term + 1) : 1;
        $oneproterm->begintime = time();
        $oneproterm->price = $oneproduct->price;
        $oneproterm->num = $oneproduct->num;
        $oneproterm->status = Oneproterm::STATUS_ONLINE;
        $oneproterm->save(false);

        // 当前上线的商品期数
        $oneproduct->oneprotermid = $oneproterm->id;
        $oneproduct->status = Oneproduct::STATUS_ONLINE;
        $oneproduct->save(false);

        for ($i = 1; $i <= $oneproterm->num; $i++) {
            // 04102100011 生成抽奖号码
            $lotteryno = sprintf("%03d%03d%05d", $oneproterm->oneproductid, $oneproterm->term, $i);
            $onelottery = new Onelottery();
            $onelottery->oneproductid = $oneproterm->oneproductid;
            $onelottery->term = $oneproterm->term;
            $onelottery->lotteryno = $lotteryno;
            $onelottery->save(false);
        }
        $transaction->commit();
        return [
            'forceReload' => '#crud-datatable-pjax',
            'title' => "上线 #" . $id,
            'content' => '<span class="text-success">上线成功</span>',
            'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
        ];

    }

    /**
     * Finds the Oneproduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Oneproduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Oneproduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
