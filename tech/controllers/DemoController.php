<?php
namespace tech\controllers;

use Yii;
use yii\web\Controller;

class DemoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
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
     * Calendar 组件.
     *
     * @return mixed
     */
    public function actionCalendar()
    {
        $event = new \yii2fullcalendar\models\Event();
        $event->id = 1;
        $event->title = 'Testing the calendar title';
        $event->start = date('Y-m-d\TH:i:s\Z');
        $event->textColor = 'red';
        $events[] = $event;
        return $this->render('calendar', ['events' => $events]);
    }

}


