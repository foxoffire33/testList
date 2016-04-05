<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ClientTest;
use common\models\Antwoord;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Score */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_test_id')->dropDownList(ArrayHelper::map(ClientTest::find()->all(),'id','test.name')) ?>

    <?= $form->field($model, 'antwoord_id')->dropDownList(ArrayHelper::map(Antwoord::find()->all(), 'id', 'text')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
