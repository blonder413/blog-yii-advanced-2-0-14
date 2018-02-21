<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Comment;

/**
 * CommentSearch represents the model behind the search form of `backend\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article_id'], 'integer'],
            [['name', 'email', 'web', 'rel', 'comment', 'date', 'status', 'client_ip', 'client_port'], 'safe'],
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
        $query = Comment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
//                    'name' => SORT_ASC,
                ]
            ],
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
            'date' => $this->date,
            'article_id' => $this->article_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'rel', $this->rel])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'client_ip', $this->client_ip])
            ->andFilterWhere(['like', 'client_port', $this->client_port]);

        return $dataProvider;
    }
}
