<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (Yii::$app->user->can('user-create')): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'photo',
            //'status',
//            [
//                'attribute' => 'status',
//                'format'    => 'raw',
//                'value'     => function($searchModel) {
//                    if ($searchModel->status === 0) {
//                        return "<span class='glyphicon glyphicon-remove'></span>";
//                    } else {
//                        return "<span class='glyphicon glyphicon-ok'></span>";
//                    }
//                }
//            ],
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'filter'    => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'status',
                                //'data' => \yii\helpers\ArrayHelper::map(\backend\models\Category::find()->all(), 'id', 'category'),
                                'data'    => [User::STATUS_ACTIVE => 'ACTIVE', User::STATUS_DELETED => 'DELETED'],
                                'options' => ['placeholder' => 'Seleccione...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                  'value'     => function($searchModel) {
                                if ($searchModel->status === 0) {
                                    return "<span class='glyphicon glyphicon-remove'></span>";
                                } else {
                                    return "<span class='glyphicon glyphicon-ok'></span>";
                                }
                            }
            ],
            //'created_at',
            //'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {change-status}',
                'buttons' => [
                    'change-status' => function ($url, $model, $key) {
                        if ($model->status === User::STATUS_DELETED) {
                            return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', $url,
                                [ 'title' => Yii::t('app', 'Active this user'), ]
                            );
                        } elseif ($model->status === User::STATUS_ACTIVE) {
                            return Html::a('<span class="glyphicon glyphicon-thumbs-down"></span>', $url,
                                [ 'title' => Yii::t('app', 'Inactive this user'), ]
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
                    if ($action === 'view') {
                        return yii\helpers\Url::to(['user/view', 'id' => $key]);
                    } elseif ($action === 'change-status') {
                        return yii\helpers\Url::to(['user/change-status', 'id' => $key]);
                    } elseif ($action == 'update') {
                        return yii\helpers\Url::to(['user/update/', 'id' => $key]);
                    } elseif ($action === 'delete') {
                        return yii\helpers\Url::to(['user/delete/', 'id' => $key]);
                    }
                }
            ],
        ],
        'rowOptions'    => function($model){
            if ($model->status == User::STATUS_DELETED) {
                return ['class' => 'danger'];
            } elseif ($model->status == User::STATUS_ACTIVE) {
                return ['class' => 'success'];
            }
        },
    ]); ?>
</div>
