<?php

namespace pay\wxsdk;

/**
 *
 * 接口调用结果类
 * @author widyhu
 *
 */
class WxPayResults extends WxPayDataBase
{

    /**
     *
     * 检测签名
     */
    public function CheckSign($config=[])
    {
        //fix异常
        if (!$this->IsSignSet()) {
            throw new WxPayException("签名错误！没设置sign!");
        }

        $sign = $this->MakeSign($config);
        if ($this->GetSign() == $sign) {
            return true;
        }
        throw new WxPayException("签名错误！");
    }

    /**
     *
     * 使用数组初始化
     * @param array $array
     */
    public function FromArray($array)
    {
        $this->values = $array;
    }

    /**
     *
     * 使用数组初始化对象
     * @param array $array
     * @param 是否检测签名 $noCheckSign
     */
    public static function InitFromArray($array, $noCheckSign = false)
    {
        $obj = new self();
        $obj->FromArray($array);
        if ($noCheckSign == false) {
            $obj->CheckSign();
        }
        return $obj;
    }

    /**
     *
     * 设置参数
     * @param string $key
     * @param string $value
     */
    public function SetData($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
    public static function Init($xml, $config=[])
    {
        $obj = new self();
        $obj->FromXml($xml);
        //fix bug 2015-06-29
        if ($obj->values['return_code'] != 'SUCCESS') {
            return $obj->GetValues();
        }
        $obj->CheckSign($config);
        return $obj->GetValues();
    }
}
