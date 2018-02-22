<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (Yii::$app->user->can('comment-create')): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Comment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'email:email',
            //'web',
            //'rel',
            //'comment:ntext',
            'date',
            //'article_id',
//            [
//                'attribute' => 'article_id',
//                'format'    => 'raw',
//                'value'     => function ($searchModel) {
//                    return Html::a($searchModel->article->title, "@web/articulo/" . $searchModel->article->slug);
//                },
//            ],
            //'status',
            //'client_ip',
            //'client_port',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {approve}',
                'buttons' => [
                    'approve' => function ($url, $model, $key) {
                        if ($model->status === 0) {
                            return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', $url,
                                [ 'title' => Yii::t('app', 'Approve comment'), ]
                            );
                        }
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                            [ 'title' => Yii::t('app', 'Actualizar'), ]
                        );
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'approve') {
                        return yii\helpers\Url::to(['comment/approve', 'id' => $key]);
                    } elseif ($action == 'update') {
                        return yii\helpers\Url::to(['comment/update/', 'id' => $key]);
                    } elseif ($action === 'delete') {
                        return yii\helpers\Url::to(['comment/delete/', 'id' => $key]);
                    } elseif ($action === 'view') {
                        return yii\helpers\Url::to(['comment/view/', 'id' => $key]);
                    }
                }
            ],
        ],
        'rowOptions'    => function($model){
            if ($model->status == Comment::STATUS_INACTIVE) {
                return ['class' => 'danger'];
            } elseif ($model->status == Comment::STATUS_ACTIVE) {
                return ['class' => 'success'];
            }
        },
    ]); ?>
</div>
