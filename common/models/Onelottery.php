<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\traits\AttrTrait;

/**
 * 该model对应数据库表 "onelottery".
 *
 * @property integer $id
 * @property string $oneorderid 订单ID
 * @property string $oneproductid 商品ID
 * @property integer $term 商品期数
 * @property string $userid 用户id
 * @property string $lotteryno 中奖号码
 * @property integer $status 状态
 * @property integer $isused 是否被使用
 * @property integer $islucky 是否中奖
 * @property string $attr 其他信息
 * @property integer $addtime
 * @property integer $modtime
 */
class Onelottery extends \yii\db\ActiveRecord
{
    use AttrTrait;

    const IS_USED_TRUE = 1;
    const IS_USED_FALSE = 0;

    const IS_LUCKY_TRUE = 1;
    const IS_LUCKY_FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'onelottery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oneorderid', 'oneproductid', 'term', 'userid', 'status', 'isused', 'islucky', 'addtime', 'modtime'], 'integer'],
            [['lotteryno'], 'string', 'max' => 50],
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
            'oneorderid' => '订单ID',
            'oneproductid' => '商品ID',
            'term' => '商品期数',
            'userid' => '用户id',
            'lotteryno' => '中奖号码',
            'status' => '状态',
            'isused' => '是否被使用',
            'islucky' => '是否中奖',
            'attr' => '其他信息',
            'addtime' => 'Addtime',
            'modtime' => 'Modtime',
        ];
    }

    public function processInfo()
    {
        return [
            'id' => $this->id,
            'oneproductid' => $this->oneproductid,
            'oneorderid' => $this->oneorderid,
            'term' => $this->term,
            'protermstatus' => $this->oneproterm->status,
            'joinednum' => self::getUsedNum($this->oneproductid, $this->term),
            'userid' => $this->userid,
            'username' => $this->user ? $this->user->name : '',
            'mobile' => $this->user ? $this->user->mobile : '',
            'orderinfo' => $this->getOneorderInfo(),
            'lotteryno' => $this->lotteryno,
            'islucky' => $this->islucky,
            'isused' => $this->isused,
            'usedate' => date('Y-m-d H:i:s', $this->modtime),
        ];
    }

    public function getOneorderInfo()
    {
        if (!$this->oneorder) {
            return [];
        }
        return $this->oneorder->processInfo();

    }

    public static function getUsedNum($oneproductid, $term)
    {
        return self::find()
            ->where(['oneproductid' => $oneproductid, 'term' => $term, 'isused' => self::IS_USED_TRUE])
            ->count();
    }

    public static function getUnusedNum($oneproductid, $term)
    {
        return self::find()
            ->where(['oneproductid' => $oneproductid, 'term' => $term, 'isused' => self::IS_USED_FALSE])
            ->count();
    }

    public static function getUnusedLotterys($oneproductid, $term, $limit = 1000)
    {
        return self::find()
            ->where(['oneproductid' => $oneproductid, 'term' => $term, 'isused' => self::IS_USED_FALSE])
            ->limit($limit)
            ->all();
    }


    public static function getLuckyNum($oneproductid, $term)
    {
        return self::find()
            ->where(['oneproductid' => $oneproductid, 'term' => $term, 'islucky' => self::IS_LUCKY_TRUE])
            ->count();
    }

    public static function isLotteryGenerated($oneproductid, $term)
    {
        return Onelottery::find()->where(['oneproductid' => $oneproductid, 'term' => $term])->exists();
    }

    public static function isLotteryAllUsed($oneproductid, $term)
    {
        return !Onelottery::find()->where(['oneproductid' => $oneproductid, 'term' => $term, 'isused' => Onelottery::IS_USED_FALSE])->exists();
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public function getOneproduct()
    {
        return $this->hasOne(Oneproduct::className(), ['id' => 'oneproductid']);
    }

    public function getOneorder()
    {
        return $this->hasOne(Oneorder::className(), ['id' => 'oneorderid']);
    }

    public function getOneproterm()
    {
        return $this->hasOne(Oneproterm::className(), ['id' => 'oneproductid'])->onCondition(['term' => $this->term]);
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
