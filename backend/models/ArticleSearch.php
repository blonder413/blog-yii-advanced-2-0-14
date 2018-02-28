<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `backend\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'type_id', 'category_id', 'visit_counter', 'download_counter', 'course_id', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'topic', 'detail', 'abstract', 'video', 'download', 'tags', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Article::find();

        // add conditions that should always apply here
        $query->joinWith(['createdBy as user_created' => function ($q) {
            $q->andFilterWhere(['=', 'user_created.username', $this->createdBy]);
        }]);

        if(!Yii::$app->user->can('admin')) {
          $query->andWhere(['user_created.id' => Yii::$app->user->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder'      => [
                    'created_at'    => SORT_DESC,
                    'title'         => SORT_ASC,
                ],
                'attributes'    => [
                    'title',
                    'created_at',
                    'visit_counter',
                    'download_counter',
                    //'commentsCount',
                    'category_id'   => [
                        'asc'   => ['categories.category' => SORT_ASC],
                        'desc'   => ['categories.category' => SORT_DESC],
                    ],
                    'course_id'   => [
                        'asc'   => ['courses.course' => SORT_ASC],
                        'desc'   => ['courses.course' => SORT_DESC],
                    ]
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
            'number' => $this->number,
            'type_id' => $this->type_id,
            'category_id' => $this->category_id,
            'visit_counter' => $this->visit_counter,
            'download_counter' => $this->download_counter,
            'course_id' => $this->course_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'download', $this->download])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
