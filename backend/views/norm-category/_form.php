<?php

use common\models\Category;
use common\models\Norm;
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
    <div class="col-sm-3">
        <?= $form->field($model, 'max')->textInput() ?>
    </div>

    <div class="row">
        <?= Html::a('Toevoegen', false, ['id' => 'addLink']); ?>
        <div class="col-sm-12" id="forumlle">

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success col-sm-12' : 'btn btn-primary col-sm-12']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $options = [
    '<' => '<',
    '<=' => '<=',
    '>' => '>',
    '>=' => '>=',
    '==' => '=='
]; ?>
<?php $this->registerJs('

    var options = ' . json_encode($options) . ';
    var next = 0;

    $(\'#addLink\').click(function(){
        var newRow = $(\'<div />\').attr({class: \'row col-sm-12\'});

        var span =$(\'<span />\').text(\'Score\').appendTo(newRow);

        var select = $(\'<select />\').attr({
        name: \'formulle[\'+next+\'][option]\'
        });

        select.appendTo(newRow);

        var input2 = $(\'<input />\').attr({
            name: \'formulle[\'+next+\'][value]\',
        }).appendTo(newRow);

         var span =$(\'<span />\').text(\'=\').appendTo(newRow);

        var input = $(\'<input />\').attr({
            name: \'formulle[\'+next+\'][true]\',
        }).appendTo(newRow);

        $.each(options, function(val, text) {
            select.append(
                $(\'<option></option>\').val(val).html(text)
            );
        });

        $(\'#forumlle\').append(newRow);
        next++;
    });
'); ?>
