<?php

namespace backend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Onelottery;

/**
 * OnelotterySearch represents the model behind the search form about `common\models\Onelottery`.
 */
class OnelotterySearch extends Onelottery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'oneorderid', 'oneproductid', 'term', 'userid', 'status', 'isused', 'islucky', 'addtime', 'modtime'], 'integer'],
            [['lotteryno', 'attr'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Onelottery::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'oneorderid' => $this->oneorderid,
            'oneproductid' => $this->oneproductid,
            'term' => $this->term,
            'userid' => $this->userid,
            'status' => $this->status,
            'isused' => $this->isused,
            'islucky' => $this->islucky,
            'addtime' => $this->addtime,
            'modtime' => $this->modtime,
        ]);

        $query->andFilterWhere(['like', 'lotteryno', $this->lotteryno])
            ->andFilterWhere(['like', 'attr', $this->attr]);
        return $dataProvider;
    }
}
