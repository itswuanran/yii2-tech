<?php
namespace frontend\forms;

use Yii;
use yii\base\Model;
use common\models\Oneorder;
use common\models\Oneproterm;
use common\models\Onelottery;
use common\models\Oneproduct;

/**
 * 一元夺宝下单
 */
class CreateOneOrderForm extends Model
{
    public $totalfee;
    public $oneproductid;
    public $quantity;
    public $term;
    private $user;

    public function rules()
    {
        return [
            [['oneproductid'], 'checkUser'],
            [['oneproductid'], 'checkOneproduct'],
            [['oneproductid'], 'checkTotalfee'],
        ];
    }

    public function load($postArr, $formName = null)
    {
        // yii2 inlinevalidator do not validate when param is null or "" or []
        $this->oneproductid = empty($postArr['oneproductid']) ? 0 : $postArr['oneproductid'];
        $this->quantity = empty($postArr['quantity']) ? 0 : $postArr['quantity'];
        $this->term = empty($postArr['term']) ? 0 : $postArr['term'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户',
            'oneproductid' => '商品id',
            'term' => '商品期数',
            'totalfee' => '待支付金额',
            'payed' => '实际支付金额',
        ];
    }

    public function checkUser($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }
        if (empty(Yii::$app->user->identity)) {
            return $this->addError($attribute, '请先登录');
        }
        $this->user = Yii::$app->user->identity;
    }

    public function checkOneproduct($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }
        $oneproduct = Oneproduct::getInstance($this->oneproductid);
        if (!$oneproduct) {
            return $this->addError($attribute, '商品不存在');
        }

        $oneproterm = Oneproterm::getOneproterm($this->oneproductid, $this->term);
        if (!$oneproterm) {
            return $this->addError($attribute, '当前期商品不存在');
        }
        if ($oneproterm->status != Oneproterm::STATUS_ONLINE) {
//            return $this->addError($attribute, '第' . $this->term . '期商品活动已结束');
        }
        if ($this->quantity > Onelottery::getUsedNum($this->oneproductid, $this->term)) {
            return $this->addError($attribute, '商品数量不足');
        }
        $this->totalfee = (floatval($this->quantity * $oneproduct->price));
    }

    public function checkTotalfee($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }
        if (!is_numeric($this->totalfee)) {
            return $this->addError($attribute, '请输入合法的金额');
        }
        $totalfee = (floatval($this->totalfee));
        if ($this->totalfee != $totalfee) {
            return $this->addError($attribute, '请输入合法的金额');
        }
        $this->totalfee = $totalfee;
    }

    public function order()
    {
        $transaction = Oneorder::getDb()->beginTransaction();
        // 创建oneorder
        $order = $this->createOneorder();
        $transaction->commit();
        return $order;
    }

    private function createOneorder()
    {
        // 创建oneorder
        $oneorder = new Oneorder();
        $oneorder->userid = $this->user->id;
        $oneorder->oneproductid = $this->oneproductid;
        $oneorder->quantity = $this->quantity;
        $oneorder->term = $this->term;
        $oneorder->totalfee = $this->totalfee;
        $oneorder->payed = $this->totalfee;
        $oneorder->ordertime = time();
        $oneorder->orderip = Yii::$app->request instanceof \yii\web\Request ? ip2long(Yii::$app->request->userIP) : 0;
        $oneorder->save(false);
        return $oneorder;
    }
}
