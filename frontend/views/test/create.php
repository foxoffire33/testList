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
    <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map(Client::find()->all(),'id','name'),['prompt'=>'Selecteer een client...']) ?>

    <?= $form->field($model, 'test_id')->dropDownList(ArrayHelper::map(Test::find()->all(),'id','name'),['prompt'=>'Selecteer een test...']) ?>
    </div>
    <div id="list-group">
        <table id="questionList" class="table">
            <thead>
            <tr>
                <td width="70%">Vraag</td>
                <td>Antwoorden</td>
            </tr>
            </thead>
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
            $(\'#questionList tbody\').empty();
                //loop categories
                $.each(data,function(categoryID,category){
                    //llop vragen
                    var newthRow = $(\'<tr />\');
                    var newCategory = $(\'<th />\').attr({colspan: \'3\'}).text(category.name).appendTo(newthRow);
                    $(\'#questionList\').append(newthRow);
                    console.log(newCategory);
                     $.each(category.vragen,function(index,vraag){
                        var newRow = $(\'<tr />\');
                        $(\'<td />\').append(vraag.text).appendTo(newRow);
                            if(typeof vraag.antwoorden != \'undefined\'){
                                var andwoordenTemp = $(\'<td />\');
                                $.each(vraag.antwoorden,function(index,antwoord){
                                    var label = $(\'<label />\');
                                    $(\'<input>\').attr({type: \'radio\',name: \'Score[\'+ count +\'][antwoord_id]\',value: antwoord.id}).appendTo(label);
                                   $(label).prepend(antwoord.text+\'  \').appendTo(andwoordenTemp);
                                });
                                $(andwoordenTemp).appendTo(newRow);
                            }
                        $(\'#questionList\').append(newRow);
                        count++;
                     });
                });
            });
        });
    });


    function setValue(id,value){
    $(\'#\'+id).val(value);
    }

');
?>


