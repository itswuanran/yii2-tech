<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use common\models\Lottery;
use yii\web\NotFoundHttpException;
use backend\searchs\LotterySearch;

/**
 * LotteryController implements the CRUD actions for Lottery model.
 */
class LotteryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * 列出所有的Lottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * 展示单个Lottery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title' => "Lottery #" . $id,
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
        ];
    }

    /**
     * 创建一个新的Lottery model.
     * 为了ajax使用，返回json
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Lottery();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load($request->post()) && $model->save()) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "创建Lottery",
                'content' => '<span class="text-success">创建成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('创建更多', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "创建Lottery",
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * 修改Lottery model.
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
                'title' => "Lottery #" . $id,
                'content' => '<span class="text-success">修改成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "Update Lottery #" . $id,
                'content' => $this->renderAjax('update', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * Finds the Lottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lottery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
