<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Streaming */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="streaming-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'embed')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'start')->widget(DateTimePicker::classname(), [
			'options' => ['placeholder' => 'Enter when start the streaming ...'],
			'pluginOptions' => [
				'autoclose' => true
			]
		]); ?>

		<?= $form->field($model, 'end')->widget(DateTimePicker::classname(), [
			'options' => ['placeholder' => 'Enter when end the streaming ...'],
			'pluginOptions' => [
				'autoclose' => true
			]
		]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
