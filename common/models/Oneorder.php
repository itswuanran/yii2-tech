<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\traits\AttrTrait;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * 该model对应数据库表 "oneorder".
 *
 * @property string $id
 * @property string $userid 用户
 * @property string $oneproductid 一元夺宝商品ID
 * @property integer $term 商品期数
 * @property string $totalfee 待支付金额
 * @property string $payed 实际支付金额
 * @property integer $quantity 商品数量
 * @property integer $ordertime 下单时间
 * @property integer $orderip 下单时的IP地址
 * @property integer $paytime 支付时间
 * @property integer $paymethod 支付方式
 * @property integer $status 订单状态
 * @property string $attr 订单信息
 * @property integer $addtime
 * @property integer $modtime
 */
class Oneorder extends \yii\db\ActiveRecord
{
    use AttrTrait;

    /** 订单状态:新订单 */
    const STATUS_NEW = 0;
    /** 订单状态:已支付 */
    const STATUS_PAYED = 1;
    /** 订单状态:已取消 */
    const STATUS_CANCELED = 128;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oneorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'oneproductid', 'term', 'ordertime', 'orderip', 'paytime', 'paymethod', 'status', 'addtime', 'modtime'], 'integer'],
            [['totalfee', 'payed'], 'required'],
            [['totalfee', 'payed'], 'number'],
            [['attr'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户',
            'oneproductid' => '一元夺宝商品ID',
            'term' => '商品期数',
            'quantity' => '商品数量',
            'totalfee' => '待支付金额',
            'payed' => '实际支付金额',
            'ordertime' => '下单时间',
            'orderip' => '下单时的IP地址',
            'paytime' => '支付时间',
            'paymethod' => '支付方式',
            'status' => '订单状态',
            'attr' => '订单信息',
            'addtime' => 'Addtime',
            'modtime' => 'Modtime',
        ];
    }


    public function processInfo()
    {
        return [
            'id' => $this->id,
            'userid' => $this->userid,
            'oneproductid' => $this->oneproductid,
            'term' => $this->term,
            'totalfee' => $this->totalfee,
            'payed' => $this->payed,
            'paymethod' => $this->paymethod,
            'status' => $this->status
        ];
    }

    public function getOneproduct()
    {
        return $this->hasOne(Oneproduct::className(), ['id' => 'oneproductid']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public function getOneproterm()
    {
        return $this->hasOne(Oneproterm::className(), ['id' => 'oneproductid',])->onCondition(['term' => $this->term]);
    }

    public function pay()
    {
        if ($this->status == Oneorder::STATUS_PAYED) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        $this->status = Oneorder::STATUS_PAYED;
        $this->save(false);
        $ret = $this->setLotteryNo();
        if ($ret) {
            $transaction->rollBack();
        } else {
            $transaction->commit();
        }
        return $ret;
    }

    /**
     * @return string
     */
    public function setLotteryNo()
    {
        $ret = Yii::$app->mutex->acquire('oneorder.lottery' . $this->oneproductid . '-' . $this->term);
        if (!$ret) {
            return '获取锁异常';
        }
        $onelotterys = Onelottery::getUnusedLotterys($this->oneproductid, $this->term);
        if (!$onelotterys) {
            return '可供抽奖数量不足';
        }
        shuffle($onelotterys);
        $bomblotterys = array_slice($onelotterys, 0, $this->quantity);
        foreach ($bomblotterys as $bomblottery) {
            $bomblottery->isused = Onelottery::IS_USED_TRUE;
            $bomblottery->userid = $this->userid;
            $bomblottery->oneorderid = $this->id;
            $bomblottery->lotterytime = intval(microtime(true) * 1000);
            $bomblottery->save(false);
        }
        Yii::$app->mutex->acquire('oneorder.lottery' . $this->oneproductid . '-' . $this->term);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['addtime', 'modtime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modtime'],
                ],
            ],
        ];
    }

}
