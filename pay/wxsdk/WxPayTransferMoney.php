<?php

namespace pay\wxsdk;

/**
 * 微信转账输入对象
 * @author yangchao
 * mch_appid 公众账号
 * mchid 商户号
 * nonce_str 随机字符串
 * partner_trade_no 商户订单号
 * openid 用户
 * check_name 校验用户姓名选项
 * re_user_name 收款用户姓名
 * amount 金额，单位为分
 * desc 企业付款描述信息
 * spbill_create_ip IP地址
 * sign 签名
 */

class WxPayTransferMoney extends WxPayDataBase
{
    /**
     * 设置微信分配的公众账号ID
     * @param string $value
     **/
    public function SetAppid($value)
    {
        $this->values['mch_appid'] = $value;
    }

    /**
     * 获取微信分配的公众账号ID的值
     * @return 值
     **/
    public function GetAppid()
    {
        return $this->values['mch_appid'];
    }

    /**
     * 判断微信分配的公众账号ID是否存在
     * @return true 或 false
     **/
    public function IsAppidSet()
    {
        return array_key_exists('mch_appid', $this->values);
    }

    /**
     * 设置微信支付分配的商户号
     * @param string $value
     **/
    public function SetMch_id($value)
    {
        $this->values['mchid'] = $value;
    }

    /**
     * 获取微信支付分配的商户号的值
     * @return 值
     **/
    public function GetMch_id()
    {
        return $this->values['mchid'];
    }

    /**
     * 判断微信支付分配的商户号是否存在
     * @return true 或 false
     **/
    public function IsMch_idSet()
    {
        return array_key_exists('mchid', $this->values);
    }

    /**
     * 设置商户系统内部的订单号，当没提供transaction_id时需要传这个。
     * @param string $value
     **/
    public function SetOut_trade_no($value)
    {
        $this->values['partner_trade_no'] = $value;
    }

    /**
     * 获取商户系统内部的订单号，当没提供transaction_id时需要传这个。的值
     * @return 值
     **/
    public function GetOut_trade_no()
    {
        return $this->values['partner_trade_no'];
    }

    /**
     * 判断商户系统内部的订单号，当没提供transaction_id时需要传这个。是否存在
     * @return true 或 false
     **/
    public function IsOut_trade_noSet()
    {
        return array_key_exists('partner_trade_no', $this->values);
    }

    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetNonce_str($value)
    {
        $this->values['nonce_str'] = $value;
    }

    /**
     * 获取随机字符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetNonce_str()
    {
        return $this->values['nonce_str'];
    }

    /**
     * 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsNonce_strSet()
    {
        return array_key_exists('nonce_str', $this->values);
    }

    /* openid 用户 */
    public function SetOpenid($value)
    {
        $this->values['openid'] = $value;
    }

    public function GetOpenid()
    {
        return $this->values['openid'];
    }

    public function IsOpenidSet()
    {
        return array_key_exists('openid', $this->values);
    }

    /* check_name 校验用户姓名选项 */
    public function SetCheckName($value)
    {
        $this->values['check_name'] = $value;
    }

    public function GetCheckName()
    {
        return $this->values['check_name'];
    }

    public function IsCheckNameSet()
    {
        return array_key_exists('check_name', $this->values);
    }

    /* re_user_name 收款用户姓名 */
    public function SetReUserName($value)
    {
        $this->values['re_user_name'] = $value;
    }

    public function GetReUserName()
    {
        return $this->values['re_user_name'];
    }

    public function IsReUserNameSet()
    {
        return array_key_exists('re_user_name', $this->values);
    }

    /* amount 金额, 单位为分 */
    public function SetAmount($value)
    {
        $this->values['amount'] = $value;
    }

    public function GetAmount()
    {
        return $this->values['amount'];
    }

    public function IsAmountSet()
    {
        return array_key_exists('amount', $this->values);
    }

    /* desc 企业付款描述信息 */
    public function SetDesc($value)
    {
        $this->values['desc'] = $value;
    }

    public function GetDesc()
    {
        return $this->values['desc'];
    }

    public function IsDescSet()
    {
        return array_key_exists('desc', $this->values);
    }

    /* desc 企业付款描述信息 */
    public function SetSpbillCreateIp($value)
    {
        $this->values['spbill_create_ip'] = $value;
    }

    public function GetSpbillCreateIp()
    {
        return $this->values['spbill_create_ip'];
    }

    public function IsSpbillCreateIpSet()
    {
        return array_key_exists('spbill_create_ip', $this->values);
    }
}
