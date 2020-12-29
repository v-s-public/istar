<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contact;

/**
 * ContactSearch represents the model behind the search form of `app\models\Contact`.
 */
class ContactSearch extends Contact
{
    public $numbers;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id'], 'integer'],
            [['name', 'second_name', 'numbers'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Contact::find();

        // add conditions that should always apply here
        $query->joinWith(['numbers']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['numbers'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['numbers.number' => SORT_ASC],
            'desc' => ['numbers.number' => SORT_DESC],
        ];

        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'contact_id' => $this->contact_id,
            'b_date' => $this->b_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'numbers.number', $this->numbers]);

        return $dataProvider;
    }
}
