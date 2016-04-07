<?php

use common\models\Vraag;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Andwoord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="andwoord-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <div class="col-sm-9">
            <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model,'waarde')->textInput(); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <?= $form->field($model, 'vraag_id_virtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Vraag::find()->all(), function ($element) {return $element->text;})]]); ?>
        </div>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
