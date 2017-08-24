<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\traits\AttrTrait;

/**
 * 该model对应数据库表 "proterm".
 *
 * @property integer $id
 * @property integer $productid 商品ID
 * @property integer $lotteryid 中奖id
 * @property integer $term 商品期数
 * @property string $price 价格
 * @property integer $num 参与数量
 * @property integer $status 状态
 * @property integer $begintime 开始时间
 * @property integer $endtime 结束时间
 * @property string $attr 其他信息
 * @property integer $addtime
 * @property integer $modtime
 */
class Proterm extends \yii\db\ActiveRecord
{
    use AttrTrait;

    // 下线
    const STATUS_OFFLINE = 0;
    // 上线
    const STATUS_ONLINE = 1;
    // 已开奖
    const STATUS_AWARDED = 2;

    public static $statusArr = [
        self::STATUS_OFFLINE => '未上线',
        self::STATUS_ONLINE => '已上线',
        self::STATUS_AWARDED => '已开奖',
    ];

    public function getStatusDesc()
    {
        return isset(self::$statusArr[$this->status]) ? self::$statusArr[$this->status] : '';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proterm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productid', 'term', 'num', 'begintime', 'endtime', 'addtime', 'modtime'], 'integer'],
            [['price', 'num'], 'required'],
            [['price'], 'number'],
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
            'productid' => '商品ID',
            'lotteryid' => '中奖ID',
            'term' => '商品期数',
            'price' => '价格',
            'num' => '参与数量',
            'status' => '状态',
            'begintime' => '开始时间',
            'endtime' => '结束时间',
            'attr' => '其他信息',
            'addtime' => 'Addtime',
            'modtime' => 'Modtime',
        ];
    }

    /**
     * 开奖 获取中奖号
     */
    public function getLuckyNo()
    {
        $lotterys = Lottery::find()
            ->where(['productid' => $this->productid, 'term' => $this->term])
            ->orderBy(['lotterytime' => SORT_DESC])
            ->limit(20)
            ->all();
        $sum = 0;
        foreach ($lotterys as $lottery) {
            $sum += $lottery->lotterytime;
        }
        if (empty($lotterys)) {
            return null;
        }
        $ruleresult = ($sum / count($lotterys) % $this->num) + 1;
        $luckyno = sprintf("%03d%03d%05d", $this->productid, $this->term, $ruleresult);
        return $luckyno;
    }


    public static function getProterm($productid, $term)
    {
        return self::find()->where(['productid' => $productid, 'term' => $term])->one();
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
