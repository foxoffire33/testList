<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Psycholoog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="psycholoog-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($user,'username')->textInput(); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($user,'password')->passwordInput(); ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($user, 'email')->textInput(['type' => 'email']); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
