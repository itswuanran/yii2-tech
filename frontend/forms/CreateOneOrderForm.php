<?php
namespace frontend\forms;

use Yii;
use yii\base\Model;
use common\models\Order;
use common\models\Proterm;
use common\models\Lottery;
use common\models\Product;

/**
 * 一元夺宝下单
 */
class CreateOneOrderForm extends Model
{
    public $totalfee;
    public $productid;
    public $quantity;
    public $term;
    private $user;

    public function rules()
    {
        return [
            [['productid'], 'checkUser'],
            [['productid'], 'checkProduct'],
            [['productid'], 'checkTotalfee'],
        ];
    }

    public function load($postArr, $formName = null)
    {
        // yii2 inlinevalidator do not validate when param is null or "" or []
        $this->productid = empty($postArr['productid']) ? 0 : $postArr['productid'];
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
            'productid' => '商品id',
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

    public function checkProduct($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }
        $product = Product::getInstance($this->productid);
        if (!$product) {
            return $this->addError($attribute, '商品不存在');
        }

        $proterm = Proterm::getProterm($this->productid, $this->term);
        if (!$proterm) {
            return $this->addError($attribute, '当前期商品不存在');
        }
        if ($proterm->status != Proterm::STATUS_ONLINE) {
//            return $this->addError($attribute, '第' . $this->term . '期商品活动已结束');
        }
        if ($this->quantity > Lottery::getUsedNum($this->productid, $this->term)) {
            return $this->addError($attribute, '商品数量不足');
        }
        $this->totalfee = (floatval($this->quantity * $product->price));
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
        $transaction = Order::getDb()->beginTransaction();
        // 创建order
        $order = $this->createOrder();
        $transaction->commit();
        return $order;
    }

    private function createOrder()
    {
        // 创建order
        $order = new Order();
        $order->userid = $this->user->id;
        $order->productid = $this->productid;
        $order->quantity = $this->quantity;
        $order->term = $this->term;
        $order->totalfee = $this->totalfee;
        $order->payed = $this->totalfee;
        $order->ordertime = time();
        $order->orderip = Yii::$app->request instanceof \yii\web\Request ? ip2long(Yii::$app->request->userIP) : 0;
        $order->save(false);
        return $order;
    }
}
