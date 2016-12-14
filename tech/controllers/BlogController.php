<?php
namespace tech\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use tech\models\Blog;

class BlogController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'search' => ['get'],
                    'view' => ['get'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $blogs = Blog::find()->orderBy('id desc')->all();
        return $this->render('index', [
            'blogs' => $blogs,
        ]);
    }

    public function actionSearch($q = '', $p = 1)
    {
        $blogs = Blog::find()
            ->where(['like', 'title', $q])
            ->orWhere(['like', 'content', $q])
            ->limit(10)
            ->all();
        return $this->render('search', [
            'blogs' => $blogs,
            'q' => $q,
        ]);
    }

    public function actionView($id)
    {
        if (!$blog = Blog::findOne($id)) {
            return $this->redirect(['index']);
        }
        $blog->addViewCount();
        return $this->render('view', [
            'blog' => $blog,
        ]);
    }
}
