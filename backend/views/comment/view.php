<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Comment;

/* @var $this yii\web\View */
/* @var $model backend\models\Comment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?php if($model->status == Comment::STATUS_INACTIVE): ?>
        <?= Html::a(Yii::t('app', 'Approve'), ['approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'web',
            'rel',
            'comment:ntext',
            'date',
            //'article_id',
            [
                'attribute' => 'article_id',
                //'format'      => 'raw',
                'value'     => $model->article->title,
            ],
            //'status',
            [
                'attribute' => 'status',
                //'format'      => 'raw',
                'value'     => $model->status == Comment::STATUS_ACTIVE ? 'ACTIVE' : 'INACTIVE',
            ],
            'client_ip',
            'client_port',
        ],
    ]) ?>

</div>
