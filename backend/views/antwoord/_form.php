<?php

use common\models\Vraag;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Andwoord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="andwoord-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vraag_id_virtual')->widget(Select2::classname(), [
        'pluginOptions' => [
            'data' => ArrayHelper::getColumn(Vraag::find()->all(), function ($element) {
                return $element->text;
            }),
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
