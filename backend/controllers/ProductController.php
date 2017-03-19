<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\models\Proterm;
use common\models\Product;
use common\models\Lottery;
use backend\searchs\ProductSearch;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * 列出所有的Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * 展示单个Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title' => "Product #" . $id,
            'content' => $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
        ];
    }

    /**
     * 创建一个新的Product model.
     * 为了ajax使用，返回json
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Product();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load($request->post()) && $model->save()) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "创建Product",
                'content' => '<span class="text-success">创建成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('创建更多', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "创建Product",
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('保存', ['class' => 'btn btn-primary', 'type' => "submit"])
            ];
        }
    }

    /**
     * 修改Product model.
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
                'title' => "Product #" . $id,
                'content' => '<span class="text-success">修改成功</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('编辑', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return [
                'title' => "Update Product #" . $id,
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
        $product = Product::findOne($id);
        if (!$product) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "下线 #" . $id,
                'content' => '<span class="text-error">商品不存在</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        $oldproterm = Proterm::find()->where(['productid' => $id, 'status' => Proterm::STATUS_ONLINE])->orderBy(['id' => SORT_DESC])->one();
        if (!$oldproterm) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "下线 #" . $id,
                'content' => '<span class="text-error">本期商品未上线</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }
        $oldproterm->status = Proterm::STATUS_OFFLINE;
        $oldproterm->endtime = time();
        $oldproterm->save(false);
        // 期数id置0
        $product->protermid = 0;
        $product->status = Product::STATUS_OFFLINE;
        $product->save(false);
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
        $product = Product::findOne($id);
        if (!$product) {
            return [
                'forceReload' => '#crud-datatable-pjax',
                'title' => "上线 #" . $id,
                'content' => '<span class="text-error">商品不存在</span>',
                'footer' => Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        }

        $oldproterm = Proterm::find()->where(['productid' => $id])->orderBy(['id' => SORT_DESC])->one();
        $transaction = Yii::$app->db->beginTransaction();
        $proterm = new Proterm();
        $proterm->productid = $id;
        $proterm->term = $oldproterm ? ($oldproterm->term + 1) : 1;
        $proterm->begintime = time();
        $proterm->price = $product->price;
        $proterm->num = $product->num;
        $proterm->status = Proterm::STATUS_ONLINE;
        $proterm->save(false);

        // 当前上线的商品期数
        $product->protermid = $proterm->id;
        $product->status = Product::STATUS_ONLINE;
        $product->save(false);

        for ($i = 1; $i <= $proterm->num; $i++) {
            // 04102100011 生成抽奖号码
            $lotteryno = sprintf("%03d%03d%05d", $proterm->productid, $proterm->term, $i);
            $lottery = new Lottery();
            $lottery->productid = $proterm->productid;
            $lottery->term = $proterm->term;
            $lottery->lotteryno = $lotteryno;
            $lottery->save(false);
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
