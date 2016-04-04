<?php
use common\models\Client;
use common\models\Test;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-sm-12">
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
    <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map(Client::find()->all(),'id','name'),['prompt'=>'Select...']) ?>

    <?= $form->field($model, 'test_id')->dropDownList(ArrayHelper::map(Test::find()->all(),'id','name'),['prompt'=>'Select...']) ?>
    </div>
    <div id="list-group">
        <table id="questionList" class="table">
            <thead>
            <tr>
                <td width="70%">Vraag</td>
                <td>Andwoorden</td>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($scoreModels)): ?>
                <?php $count = 0; ?>
                <?php foreach ($scoreModels as $scoreModel): ?>
                    <tr class="<?= (!empty($scoreModel->andwoord_id) ? 'success' : 'danger') ?>">
                        <?php $vraag = \common\models\Vraag::findOne($scoreModel->vraagID); ?>
                        <td><?= $vraag->text ?></td>
                        <td>
                            <?php if (isset($vraag->andwoords)): ?>
                                <?php foreach ($vraag->andwoords as $andwoord): ?>
                                    <?= Html::beginTag('label'); ?>
                                    <?= $andwoord->text ?>
                                    <?= Html::hiddenInput('Score[' . $count . '][vraagID]', $scoreModel->vraagID); ?>
                                    <?= Html::radio('Score[' . $count . '][andwoord_id]', ($andwoord->id == $scoreModel->andwoord_id), ['value' => $andwoord->id]); ?>
                                    <?= Html::endTag('label'); ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php $count++; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row buttons">
        <?= Html::submitButton('Opslaan',['class' => 'btn btn-default']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs('
    $(function(){
        var count = 0;
        $(\'#clienttest-test_id\').change(function(){
            $.ajax({
                url: \'/test/json\',
                data: {id: $(this).val()},
            }).done(function(data){
                $.each(data,function(index,value){
                var newRow = $(\'<tr />\');
                $(\'<td />\').append(value.text).appendTo(newRow);
                    if(typeof value.andwoorden != \'undefined\'){
                        var andwoordenTemp = $(\'<td />\');
                        $.each(value.andwoorden,function(index,andwoord){
                            var label = $(\'<label />\');
                            $(\'<input>\').attr({type: \'hidden\',name: \'Score[\'+ count +\'][vraagID]\',value: value.id}).appendTo(label);
                            $(\'<input>\').attr({type: \'radio\',name: \'Score[\'+ count +\'][andwoord_id]\',value: andwoord.id}).appendTo(label);
                           $(label).prepend(andwoord.text+\'  \').appendTo(andwoordenTemp);
                        });
                        $(andwoordenTemp).appendTo(newRow);
                    }
                 $(\'#questionList\').append(newRow);
                 count++;
                });

            });
        });
    });


    function setValue(id,value){
    $(\'#\'+id).val(value);
    }

');
?>


