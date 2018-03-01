<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use backend\models\Category;
use backend\models\Course;
use backend\models\Type;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'version') ?>
    
    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'detail')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            //'preset' => 'basic',   // basic | complete
    ]); ?>

    <?= $form->field($model, 'abstract')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'video')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Type::find()->all(), 'id', 'type'),
            'language' => 'es',
            'options' => ['placeholder' => 'Select a type ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ]); ?>

    <?= $form->field($model, 'download')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Category::find()->all(), 'id', 'category'),
            'language' => 'es',
            'options' => ['placeholder' => 'Select a category ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ]); ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Course::find()->all(), 'id', 'course'),
            'language' => 'es',
            'options' => ['placeholder' => 'Select a course ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
