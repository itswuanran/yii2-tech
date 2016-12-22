<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\traits\AttrTrait;

/**
 * 该model对应数据库表 "oneproduct".
 *
 * @property string $id
 * @property string $name 名称
 * @property string $nickname 呢称
 * @property string $desc 描述
 * @property integer $categoryid 品类
 * @property integer $num 数量
 * @property string $headimg 产品缩略图
 * @property resource $details 详情页
 * @property integer $status 状态
 * @property string $price 价格
 * @property string $attr 其他信息
 * @property integer $addtime
 * @property integer $modtime
 */
class Oneproduct extends \yii\db\ActiveRecord
{
    use AttrTrait;

    public $categoryid1;
    public $categoryid2;

    const STATUS_ONLINE = 1;
    const STATUS_OFFLINE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oneproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryid', 'status', 'num', 'addtime', 'modtime'], 'integer'],
            [['details'], 'string'],
            [['name', 'price', 'num'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 32],
            [['nickname'], 'string', 'max' => 16],
            [['desc'], 'string', 'max' => 256],
            [['headimg'], 'string', 'max' => 512],
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
            'name' => '名称',
            'nickname' => '呢称',
            'desc' => '描述',
            'categoryid' => '品类',
            'headimg' => '产品缩略图',
            'details' => '详情页',
            'status' => '状态',
            'num' => '商品数量',
            'price' => '价格',
            'attr' => '其他信息',
            'addtime' => 'Addtime',
            'modtime' => 'Modtime',
        ];
    }

    public static function getInstance($id)
    {
        return self::findOne($id);
    }

    public function processInfo()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'categoty' => $this->category,
            'desc' => $this->desc,
            'details' => $this->details,
            'price' => $this->price,
            'num' => $this->num,
            'term' => $this->oneproterm ? $this->oneproterm->term : 0,
        ];
        return $data;
    }

    public function getOneproterm()
    {
        return $this->hasOne(Oneproterm::className(), ['id' => 'oneprotermid']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryid']);
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
