<?php

namespace frontend\controllers;

use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\Module;
use filsh\yii2\oauth2server\Response;
use filsh\yii2\oauth2server\Server;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

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

        $params = Yii::$app->request->get();
        if (Yii::$app->request->isGet) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
            $err = new Response();
            $ret = $server->validateAuthorizeRequest($request, $err);
            if (!$ret) {
                throw new HttpException($err->getStatusCode(), $err->getParameter('error_description'), $err->getParameter('error_uri'));
            }
            return $this->render('authorize', ['params' => $params]);
        }
        $response = $server->handleAuthorizeRequest($request, new Response(), true);
        return Yii::$app->response->redirect($response->getHttpHeader('Location'));
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