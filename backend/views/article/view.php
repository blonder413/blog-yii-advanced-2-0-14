<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
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
            'number',
            'title',
            'slug',
            'topic',
            'detail:ntext',
            'abstract',
            'video',
            'type.type',
            'download',
            'category.category',
            'tags',
            'status',
            'visit_counter',
            'download_counter',
            'course.course',
            //'created_by',
            [
                'attribute' => 'created_by',
                //'format'      => 'raw',
                'value'     => $model->createdBy->name,
            ],
            'created_at',
            //'updated_by',
            [
                'attribute' => 'updated_by',
                //'format'      => 'raw',
                'value'     => $model->createdBy->name,
            ],
            'updated_at',
        ],
    ]) ?>

</div>
