<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Client;
use common\models\Test;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ClientTest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map(Client::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'test_id')->dropDownList(ArrayHelper::map(Test::find()->all(),'id','name')) ?>

    <div class="form-group">

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
