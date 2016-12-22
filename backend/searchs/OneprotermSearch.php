<?php

namespace backend\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Oneproterm;

/**
 * OneprotermSearch represents the model behind the search form about `common\models\Oneproterm`.
 */
class OneprotermSearch extends Oneproterm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'oneproductid', 'term', 'num', 'begintime', 'endtime', 'addtime', 'modtime', 'status'], 'integer'],
            [['price'], 'number'],
            [['attr'], 'safe'],
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
        $query = Oneproterm::find();

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
            'oneproductid' => $this->oneproductid,
            'term' => $this->term,
            'price' => $this->price,
            'num' => $this->num,
            'begintime' => $this->begintime,
            'endtime' => $this->endtime,
            'addtime' => $this->addtime,
            'modtime' => $this->modtime,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'attr', $this->attr]);

        return $dataProvider;
    }
}
