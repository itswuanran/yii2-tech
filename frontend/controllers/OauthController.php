<?php

namespace frontend\controllers;

use Yii;
use filsh\yii2\oauth2server\Module;
use filsh\yii2\oauth2server\Response;
use filsh\yii2\oauth2server\Server;
use yii\helpers\ArrayHelper;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;

class OauthController extends \yii\rest\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
        ]);
    }

    public function actionToken()
    {
        /**
         * @var Module $module
         * @var Server $server
         * @var Response $response
         */
        $module = Yii::$app->getModule('oauth2');
        $server = $module->getServer();

        $response = $server->handleTokenRequest();
        return $response->getParameters();
    }

    public function actionAuthorize()
    {
        /**
         * @var Module $module
         * @var Server $server
         * @var Response $response
         */
        $module = Yii::$app->getModule('oauth2');
        $request = $module->getRequest();
        $server = $module->getServer();
        $server->setConfig('require_exact_redirect_uri', false);

        if (Yii::$app->request->isGet) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
            $ret = $server->validateAuthorizeRequest($request, new Response());
            //TODO 错误信息提示
            return $this->render('authorize');
        }

        $response = $server->handleAuthorizeRequest($request, new Response(), true);
        Yii::$app->response->redirect($response->getHttpHeader('Location'));
    }

    public function actionAuthcode()
    {
        /**
         * @var Module $module
         * @var Server $server
         * @var Response $response
         */
        // 获取到code，下一步访问token接口拿code换AccessToken.
        var_dump(Yii::$app->request->get('code'));
        $code = Yii::$app->request->get('code');
        [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => 'testclient',
            'client_secret' => '库中的secret',
            'redirect_uri' => '',
        ];
    }

}