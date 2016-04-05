<?php

use common\models\Vraag;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Test */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Bewerk', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Verwijder', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Weet u zeker dat u dit wilt verwijderen',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>


    <div class="col-sm-8">
        <h3>Vragen</h3>
        <?php if (!empty($model->vraags)): ?>
            <ul class="list-group">
                <?php foreach ($model->vraags as $vraag): ?>
                    <li class="list-group-item">
                        <strong><?= Html::a($vraag->text, ['/vraag/view', 'id' => $vraag->id]); ?></strong>
                        <div class="badge"><?= count($vraag->antwoorden) ?></div>
                        <ul class="list-group">
                            <?php foreach ($vraag->antwoorden as $andwoord): ?>
                                <li class="list-group-item"><?= Html::a($andwoord->text, ['/andwoord/view', 'id' => $andwoord->id]) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="col-sm-4">
        <h3>Vraag toevoegen</h3>
        <?php $form = ActiveForm::begin([
            'action' => ['/vraag/create']
        ]); ?>
        <?= $form->field(new Vraag(), 'test_id')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= $form->field(new Vraag(), 'text')->textInput(['placeholder' => $model->getAttributeLabel('text')])->label(false); ?>
        <div class="row">
            <?= Html::submitButton('Opslaan',['class' => 'btn btn-lg btn-default col-sm-10 col-sm-offset-1']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
