<?php
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Security;

$this->title =  Html::encode( '(' . $pending . ') Comments');

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            // 'email:email',
            [
                'attribute' => 'email',
                'format'    => 'email',
                'value'     => function ($searchModel) {
                    return Security::decrypt($searchModel->email);
                }
            ],
            // 'web',
            //[
            //    'attribute' => 'web',
            //    'format'    => 'url',
            //],
            // 'rel',
            //'comment:ntext',
            // 'date',
            [
                'attribute' => 'date',
                'format' => ['date', 'php:D d M Y H:i:s'],
            ],
            // 'article_id',
            //[
            //    'attribute' => 'article_id',
            //    'format'    => 'raw',
            //    'value'     => function ($searchModel) {
            //        return Html::a($searchModel->article->title, "@web/articulo/" . $searchModel->article->slug);
            //    },
            //],
            //'status',
            // [
            //    'attribute' => 'status',
            //    'format'    => 'boolean',
            //    'header'    => 'Publicado',
            // ],
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'value'     => function($searchModel) {
                    if ($searchModel->status === 0) {
                        return "<span class='glyphicon glyphicon-remove'></span>";
                    } else {
                        return "<span class='glyphicon glyphicon-ok'></span>";
                    }
                }
            ],
            'client_ip',
            // 'client_port',

            //[
            //    'class' => 'yii\grid\ActionColumn',
            //    'template' => '{view} {update} {delete}'
            //],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {approve}',
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
                    }
                }
            ],
        ],
        'rowOptions'    => function($model){
            if (!$model->status) {
                return ['class' => 'danger'];
            }
        },
    ]);
