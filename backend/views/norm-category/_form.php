<?php

use common\models\Norm;
use common\models\Category;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NormCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="norm-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'norm_id_virtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Norm::find()->all(), function ($element) {return $element->name;})]]); ?>
    </div>
    <div class="col-sm-6">
              <?= $form->field($model, 'norm_category_id_virtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Category::find()->all(), function ($element) {return $element->name;})]]); ?>
    </div>
    <div class="col-sm-9">
        <?= $form->field($model, 'formule')->textInput() ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'max')->textInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success col-sm-12' : 'btn btn-primary col-sm-12']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
