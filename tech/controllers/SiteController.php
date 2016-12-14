<?php
namespace tech\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use tech\models\Blog;

class SiteController extends Controller
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
                    'about' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 红领巾博客介绍
     */
    public function actionAbout()
    {
        $data = Blog::find()
            ->select(['userid', 'count(*) count', 'group_concat(addtime) stats'])
            ->groupBy(['userid'])
            ->orderBy('count desc')
            ->asArray()
            ->all();
        array_walk($data, function (&$value) {
            $stats = array_fill(0, 4, 0);
            $dates = explode(',', $value['stats']);
            foreach ($dates as $date) {
                $diff = date('W') - date('W', $date);
                if (isset($stats[$diff])) {
                    $stats[$diff]++;
                }
            }
            $value['stats'] = implode(',', array_reverse($stats));
        });
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['userid', 'count'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('about', ['data' => $data, 'dataProvider' => $dataProvider]);
    }
}
