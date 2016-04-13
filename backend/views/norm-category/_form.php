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
        <div class="col-sm-6">
        <?= $form->field($model, 'max')->textInput() ?>
    </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'default')->textInput() ?>
    </div>

        <div class="row">
            <?= Html::a('Toevoegen', false, ['id' => 'addLink']); ?>
            <table class="table table-bordered table-striped" id="formule-lines">
                <thead>
                <tr>
                    <th>Score</th>
                    <th>Dan</th>
                    <th>=</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($formules)): ?>
                    <?php $index = 0 ?>
                    <?php foreach ($formules as $formule): ?>
                        <tr>
                            <td><?= Html::dropDownList('formule[' . $index . '][option]', $formule->option, $model->formulleOptions, ['class' => 'form-control']) ?></td>
                            <td width="200"><?= Html::textInput('formule[' . $index . '][value]', $formule->value, ['class' => 'form-control']) ?></td>
                            <td width="200"><?= Html::textInput('formule[' . $index . '][true]', $formule->true, ['class' => 'form-control']) ?></td>
                            <td width="20"><?= Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', ['class' => 'remove-invoice-line']) ?></td>
                        </tr>
                        <?php ++$index ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success col-sm-12' : 'btn btn-primary col-sm-12']) ?>
    </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$nextIndex = 0;
$this->registerJs('
var nextIndex = ' . count($formules) . ';
var jsonoptions = ' . json_encode($model->formulleOptions) . ';

    $(\'#addLink\').click(addLine);

    $(\'.remove-invoice-line\').click(removeLine);
    function addLine(){
        $newRow = $(\'<tr/>\');
        $(\'<td/>\').append(formGroup(\'option\', selectInput(\'option\',jsonoptions))).appendTo($newRow);
        $(\'<td/>\').attr({width: \'200\'}).append(formGroup(\'value\', textInput(\'value\'))).appendTo($newRow);
        $(\'<td/>\').attr({width: \'200\'}).append(formGroup(\'true\', textInput(\'true\'))).appendTo($newRow);
        $(\'<td/>\').attr({width: \'20\'}).append(hiddenInput(\'id\')).append(deleteIcon()).appendTo($newRow);
        $(\'#formule-lines\').append($newRow);
        ++nextIndex;
    }

    function removeLine(){
        $(this).closest(\'tr\').remove();
        return false;
    }

    function textInput(attribute){
        return $(\'<input/>\', {
        id: \'formule\' + nextIndex + \'-\' + attribute.toLowerCase(),
        class: \'form-control\',
        type: \'text\',
        name: \'formule[\' + nextIndex + \'][\' + attribute + \']\'
        });
    }

    function selectInput(attribute, options){
         var select = $(\' <select/>\').attr({
                id: \'formule\' + nextIndex + \'-\' + attribute.toLowerCase(),
                class: \'form-control\',
                name: \'formule[\' + nextIndex + \'][\' + attribute + \']\'
            });
          $.each(options, function(val, text) {
            select.append($(\' <option></option > \').val(val).html(text));
          });
        return select;
    }

    function formGroup(attribute, input){
        return $(\'<div/>\', {
        class: \'form-group field-formule\' + nextIndex + \'-\' + attribute.toLowerCase() + \' required\'
        }).append(input);
    }

    function hiddenInput(attribute){
        return $(\'<input/>\', {
        id:  + nextIndex + \'-\' + attribute.toLowerCase(),
        type: \'hidden\',
        name:  nextIndex + \'][\' + attribute + \']\'
        });
    }

    function deleteIcon(){
        return $(\'<a/>\', {
        class: \'remove-invoice-line\',
        href: \'#\'
        }).append($(\'<span/>\', {
        class: \'glyphicon glyphicon-trash\'
        })).click(removeLine);
    }');
?>