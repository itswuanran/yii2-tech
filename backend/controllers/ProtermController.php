<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use common\models\Lottery;
use common\models\Proterm;
use backend\searchs\ProtermSearch;

/**
 * ProtermController implements the CRUD actions for Proterm model.
 */
class ProtermController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * 列出所有的Proterm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProtermSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * 展示单个Proterm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title' => "Proterm #" . $id,
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
        ];
    }

    /**
     * 创建一个新的Proterm model.
     * 为了ajax使用，返回json
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Proterm();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load($request->post()) && $model->save()) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "创建Proterm",
                'content' => '<span class="text-success">创建成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('创建更多', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "创建Proterm",
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * 修改Proterm model.
     * ajax请求返回json数据
     * @param integer $id
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
                'title' => "Proterm #" . $id,
                'content' => '<span class="text-success">修改成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "Update Proterm #" . $id,
                'content' => $this->renderAjax('update', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * 手动开奖
     * @param $id
     * @return array
     */
    public function actionAward($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $proterm = Proterm::findOne($id);
        if (!$proterm || $proterm->status == Proterm::STATUS_AWARDED) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "开奖 #" . $id,
                'content' => '<span class="text-danger">已经开奖</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        if (!Lottery::isLotteryGenerated($proterm->productid, $proterm->term)) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "开奖 #" . $id,
                'content' => '<span class="text-danger">抽奖券未生成</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        if (!Lottery::isLotteryAllUsed($proterm->productid, $proterm->term)) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "开奖 #" . $id,
                'content' => '<span class="text-danger">购买人数不足,不能开奖</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        $luckynum = $proterm->getLuckyNo();
        if (!$luckynum || !$lottery = Lottery::find()->where(['lotteryno' => $luckynum])->one()) {
            Yii::error("中奖号码: $luckynum id:$proterm->id 有误 及时联系RD");
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "开奖 #" . $id,
                'content' => '<span class="text-danger">中奖号码有误 及时联系RD</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        $lottery->islucky = Lottery::IS_LUCKY_TRUE;
        $lottery->save(false);
        $proterm->status = Proterm::STATUS_AWARDED;
        $proterm->lotteryid = $lottery->id;
        $proterm->save(false);
        return [
            'forceReload' => '#crud-datatable-pjax',
            'title' => "开奖 #" . $id,
            'content' => '<span class="text-success">开奖成功 中奖号码是' . $luckynum . '</span>',
            'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
        ];
    }

    /**
     * Finds the Proterm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proterm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proterm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
