<?php

namespace pay\wxsdk;

class PayNotifyCallBack extends WxPayNotify
{
    public $config;

    public function loadConfig($config)
    {
        $this->config = $config;
    }

    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $wxPayApi = new WxPayApi($this->config);
        $result = $wxPayApi->orderQuery($input);
        Yii::info("query:" . json_encode($result));
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS"
        ) {
            return true;
        }
        return false;
    }

    // 重写回调处理函数
    // NOTICE: 微信服务器在调用失败或者接到回包为非确认包的时候，会发起重试，需确保你的回调是可以重入
    public function NotifyProcess($data, &$msg)
    {
        $notfiyOutput = array();
        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }
    }
}
