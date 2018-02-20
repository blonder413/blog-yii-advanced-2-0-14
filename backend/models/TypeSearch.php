<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Type;

/**
 * TypeSearch represents the model behind the search form of `backend\models\Type`.
 */
class TypeSearch extends Type
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'safe'],
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
        $query = Type::find();

        // add conditions that should always apply here
        $query->joinWith(['createdBy as user_created' => function ($q) {
            $q->andFilterWhere(['=', 'user_created.username', $this->createdBy]);
        }]);

        $query->joinWith(['updatedBy as user_updated' => function ($q) {
            $q->andFilterWhere(['=', 'user_updated.username', $this->updatedBy]);
        }]);

//        $query->joinWith(['createdBy' => function ($q) {
//            $q->andFilterWhere(['=', 'users.username', $this->createdBy]);
//        }])->alias('user_created');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            //'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
              ->andFilterWhere(['like', 'user_created.name', $this->created_by])
              ->andFilterWhere(['like', 'user_updated.name', $this->updated_by]);

        return $dataProvider;
    }
}
