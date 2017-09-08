<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Category;

class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index', 'create', 'view', 'update',
                            'image', 'list',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['second', 'third'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);
        $data = (Category::getCategoryTree());
        return $this->render('index', [
            'data' => $data,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();
        $post = Yii::$app->request->post();
        if (isset($post['pid']) && $post['name']) {
            $model->pid = $post['pid'];
            $model->name = $post['name'];
            $ret = $model->save(false);
            if ($ret) {
                return 1;
            }
        }
        return 0;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if (isset($post['name']) && !empty($post['name'])) {
            $model->name = $post['name'];
            $ret = $model->save(false);
            if ($ret) {
                return 1;
            }
        }
        return 0;
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->post('id', '');
        if (!$id) {
            return '数据格式不正确';
        }
        $categorys = Category::find()->where(['pid' => $id])->orWhere(['id' => $id])->all();
        if (!$categorys) {
            return '请选择正确的分类';
        }
        return $this->batchDelete($categorys, 100);
    }


    private function batchDelete($recordArrs, $batchNum = 100)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $count = 0;
            foreach ($recordArrs as $recordArr) {
                $recordArr->delete();
                if (++$count % $batchNum == 0) {
                    $transaction->commit();
                    sleep(1);
                    $transaction = Yii::$app->db->beginTransaction();
                }
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return '删除失败';
        }
        return false;
    }

    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('您请求的页面不存在');
        }
    }


    public static function getSubCatList($pid)
    {
        return Category::find()->where(['pid' => $pid])->asArray()->all();
    }

    public function actionSecond()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionThird()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $out = self::getSubCatList($subcat_id);
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionList($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = Category::find()->select('id As id, name AS text')
                ->from('category')
                ->where(['like', 'name', $q]);
            $data = $query->asArray()->all();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $obj = Category::findOne($id);
            if ($obj) {
                $out['results'] = ['id' => $id, 'text' => $obj->name];
            }
        }
        return $out;
    }
}
