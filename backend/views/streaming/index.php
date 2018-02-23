<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StreamingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Streamings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streaming-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (Yii::$app->user->can('streaming-create')): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Streaming'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description:ntext',
            //'embed',
            //'start',
            [
                'attribute' => 'start',
                'filter'    => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start',
                    //'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            //'format' => 'dd-M-yyyy',
                            'format' => 'yyyy-mm-dd',
                        ]
                ]),
                'format'    => 'raw',
                'value'     => 'start',
            ],
            //'end',
            [
                'attribute' => 'end',
                'filter'    => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end',
                    //'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            //'format' => 'dd-M-yyyy',
                            'format' => 'yyyy-mm-dd',
                        ]
                ]),
                'format'    => 'raw',
                'value'     => 'end',
            ],
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
