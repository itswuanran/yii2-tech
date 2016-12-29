<?php

namespace pay\alipay;

/* *
 * 配置文件
 * 版本：3.4
 * 修改日期：2016-03-08
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */

class AlipayConfig
{
    //合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
    const partner = 'x';
    const another_partner = 'x';

    //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
    const seller_id = self::partner;
    const another_seller_id = self::another_partner;

    //
    const seller_user_id = self::partner;
    const another_seller_user_id = self::another_partner;

    const seller_email = 'xxx@xxx.xyz';
    const another_seller_email = 'xxx@xxx.com';

    //商户的私钥,此处填写原始私钥，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1

    const private_key_path = 'key/rsa_private_key.pem';
    const another_private_key_path = 'key/another_rsa_private_key.pem';

    //支付宝的公钥，查看地址：https://b.alipay.com/order/pidAndKey.htm
    const ali_public_key_path = 'key/alipay_public_key.pem';
    const another_ali_public_key_path = 'key/another_alipay_public_key.pem';

    // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const notify_url = "http://pay.xxx.com/notify/alipay-wap";
    const notify_url_app = "http://pay.xxx.com/notify/alipay-app";
    const another_notify_url = "http://pay.xxx.com/notify/alipay-another-wap";

    // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const return_url = "http://pay.xxx.com/trade/test";
    const return_url_app = "http://pay.xxx.com/trade/test";
    const another_return_url = "http://pay.xxx.com/trade/test";
    const another_return_url_app = "http://pay.xxx.com/trade/test";

    // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const notify_url_refund = "http://pay.xxx.com/notify/alipay-refund";
    const notify_url_app_refund = "http://pay.xxx.com/notify/alipay-refund";
    const another_notify_url_refund = "http://pay.xxx.com/notify/alipay-another-refund";
    const another_notify_url_app_refund = "http://pay.xxx.com/notify/alipay-another-refund";

    // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const return_url_refund = "http://pay.xxx.com/trade/test";
    const return_url_app_refund = "http://pay.xxx.com/trade/test";
    const another_return_url_refund = "http://pay.xxx.com/trade/test";
    const another_return_url_app_refund = "http://pay.xxx.com/trade/test";

    //签名方式
    const sign_type = 'RSA';
    const another_sign_type = 'RSA';

    //字符编码格式 目前支持utf-8
    const input_charset = 'utf-8';
    const another_input_charset = 'utf-8';

    //ca证书路径地址，用于curl中ssl校验，请保证cacert.pem文件在当前文件夹目录中
    const cacert = 'key/cacert.pem';
    const another_cacert = 'key/cacert.pem';

    //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    const transport = 'http';
    const another_transport = 'http';

    // 支付类型 ，无需修改
    const payment_type = "1";
    const another_payment_type = "1";

    //wap pay
    const service = "alipay.wap.create.direct.pay.by.user";
    //wap refund
    const service_refund = "refund_fastpay_by_platform_nopwd";
    //app pay
    const app_service = "mobile.securitypay.pay";
    //app refund
    const app_service_refund = "refund_fastpay_by_platform_nopwd";
    //another wap pay
    const another_service = "alipay.wap.create.direct.pay.by.user";
    //another wap refund
    const another_service_refund = "refund_fastpay_by_platform_nopwd";
    //another app pay
    const another_app_service = "mobile.securitypay.pay";
    //another app refund
    const another_app_service_refund = "refund_fastpay_by_platform_nopwd";


    // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const test_notify_url = "http://pay.xxx.com/notify/alipay-wap";
    const test_notify_url_app = "http://pay.xxx.com/notify/alipay-app";
    const test_another_notify_url = "http://pay.xxx.com/notify/alipay-another-wap";

    // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const test_return_url = "http://pay.xxx.com/trade/test";
    const test_return_url_app = "http://pay.xxx.com/trade/test";
    const test_another_return_url = "http://pay.xxx.com/trade/test";
    const test_another_return_url_app = "http://pay.xxx.com/trade/test";

    // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const test_notify_url_refund = "http://pay.xxx.com/notify/alipay-refund";
    const test_notify_url_app_refund = "http://pay.xxx.com/notify/alipay-refund";
    const test_another_notify_url_refund = "http://pay.xxx.com/notify/alipay-another-refund";
    const test_another_notify_url_app_refund = "http://pay.xxx.com/notify/alipay-another-refund";

    // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
    const test_return_url_refund = "http://pay.xxx.com/trade/test";
    const test_return_url_app_refund = "http://pay.xxx.com/trade/test";
    const test_another_return_url_refund = "http://pay.xxx.com/trade/test";
    const test_another_return_url_app_refund = "http://pay.xxx.com/trade/test";

    public static function initConfig()
    {
        $configArr = [
            'h5' => [
                'partner' => self::partner,
                'seller_id' => self::seller_id,
                'private_key' => dirname(dirname(__DIR__)) . self::private_key_path,
                'alipay_public_key' => dirname(dirname(__DIR__)) . self::ali_public_key_path,
                'notify_url' => YII_DEBUG ? self::test_notify_url : self::notify_url,
                'return_url' => YII_DEBUG ? self::test_return_url : self::return_url,
                'sign_type' => self::sign_type,
                'input_charset' => self::input_charset,
                'cacert' => dirname(dirname(__DIR__)) . self::cacert,
                'transport' => self::transport,
                'payment_type' => self::payment_type,
                'service' => self::service,
            ],
            'app' => [
                'partner' => self::partner,
                'seller_id' => self::seller_id,
                'private_key' => dirname(dirname(__DIR__)) . self::private_key_path,
                'alipay_public_key' => dirname(dirname(__DIR__)) . self::ali_public_key_path,
                'notify_url' => YII_DEBUG ? self::test_notify_url_app : self::notify_url_app,
                'return_url' => YII_DEBUG ? self::test_return_url_app : self::return_url_app,
                'sign_type' => self::sign_type,
                'input_charset' => self::input_charset,
                'cacert' => dirname(dirname(__DIR__)) . self::cacert,
                'transport' => self::transport,
                'payment_type' => self::payment_type,
                'service' => self::app_service,
            ],
            'another-h5' => [
                'partner' => self::another_partner,
                'seller_id' => self::another_seller_id,
                'private_key' => dirname(dirname(__DIR__)) . self::another_private_key_path,
                'alipay_public_key' => dirname(dirname(__DIR__)) . self::another_ali_public_key_path,
                'notify_url' => YII_DEBUG ? self::test_another_notify_url : self::another_notify_url,
                'return_url' => YII_DEBUG ? self::test_another_return_url : self::another_return_url,
                'sign_type' => self::another_sign_type,
                'input_charset' => self::another_input_charset,
                'cacert' => dirname(dirname(__DIR__)) . self::another_cacert,
                'transport' => self::another_transport,
                'payment_type' => self::another_payment_type,
                'service' => self::another_service,
            ],
        ];
        return $configArr;
    }

    public static function initRefundConfig()
    {
        $configRefundArr = [
            'h5' => [
                'service' => self::service_refund,
                'partner' => self::partner,
                'seller_user_id' => self::seller_user_id,
                'private_key' => dirname(dirname(__DIR__)) . self::private_key_path,
                'alipay_public_key' => dirname(dirname(__DIR__)) . self::ali_public_key_path,
                'sign_type' => self::sign_type,
                'input_charset' => self::input_charset,
                'notify_url' => YII_DEBUG ? self::test_notify_url_refund : self::notify_url_refund,
                'refund_date' => date('Y-m-d H:i:s', time()),
                'transport' => self::transport,
                'cacert' => dirname(dirname(__DIR__)) . self::cacert,
                'seller_email' => self::seller_email,
            ],
            'app' => [
                'service' => self::app_service_refund,
                'partner' => self::partner,
                'seller_user_id' => self::seller_user_id,
                'private_key' => dirname(dirname(__DIR__)) . self::private_key_path,
                'alipay_public_key' => dirname(dirname(__DIR__)) . self::ali_public_key_path,
                'sign_type' => self::sign_type,
                'input_charset' => self::input_charset,
                'notify_url' => YII_DEBUG ? self::test_notify_url_app_refund : self::notify_url_app_refund,
                'refund_date' => date('Y-m-d H:i:s', time()),
                'transport' => self::transport,
                'cacert' => dirname(dirname(__DIR__)) . self::cacert,
                'seller_email' => self::seller_email,
            ],
            'another-app' => [
                'service' => self::another_service_refund,
                'partner' => self::another_partner,
                'seller_user_id' => self::another_seller_user_id,
                'private_key' => dirname(dirname(__DIR__)) . self::another_private_key_path,
                'alipay_public_key' => dirname(dirname(__DIR__)) . self::ali_public_key_path,
                'sign_type' => self::another_sign_type,
                'input_charset' => self::another_input_charset,
                'notify_url' => YII_DEBUG ? self::test_another_notify_url_refund : self::another_notify_url_refund,
                'refund_date' => date('Y-m-d H:i:s', time()),
                'transport' => self::another_transport,
                'cacert' => dirname(dirname(__DIR__)) . self::another_cacert,
                'seller_email' => self::another_seller_email,
            ],
        ];
        return $configRefundArr;
    }

    public static function getWapConfig($configName = 'h5')
    {
        $configArr = self::initConfig();
        if (isset($configArr[$configName])) {
            return $configArr[$configName];
        }
        return new \Exception("配置错误");
    }

    public static function getAppConfig($configName = 'h5')
    {
        if (isset($configArr[$configName])) {
            return $configArr[$configName];
        }
        return new \Exception("配置错误");
    }

    public static function getRefundWapConfig($configName = 'h5')
    {
        $configRefundArr = self::initRefundConfig();
        if (isset($configRefundArr[$configName])) {
            return $configRefundArr[$configName];
        }
        return new \Exception("配置错误");
    }

    public static function getRefundAppConfig($configName = 'h5')
    {
        $configRefundArr = self::initRefundConfig();
        if (isset($configRefundArr[$configName])) {
            return $configRefundArr[$configName];
        }
        return new \Exception("配置错误");
    }
}
