<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\models\Antwoord;

/* @var $this yii\web\View */
/* @var $model common\models\Vraag */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vraags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vraag-view">

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
            'text',
            'category.name' => [
                'attribute' => 'category.name',
                'format' => 'html',
                'value' => Html::a($model->category->name, ['/test/view', 'id' => $model->category->id])
            ],
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
<div class="col-sm-8">
    <h3>Antwoorden</h3>
    <?php if (!empty($model->antwoorden)): ?>
    <ul>
        <?php foreach ($model->antwoorden as $andwoord): ?>
            <li><?= Html::a($andwoord->text, ['/antwoord/view', 'id' => $andwoord->id]) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<div class="col-sm-4">
    <h3>Antwoord toevoegen</h3>
    <?php $form = ActiveForm::begin([
        'action' => ['/antwoord/create']
    ]); ?>
    <?= $form->field(new Antwoord(), 'vraag_id')->hiddenInput(['value' => $model->id])->label(false) ?>
    <?= $form->field(new Antwoord(), 'text')->textInput(['placeholder' => $model->getAttributeLabel('text')])->label(false); ?>
    <div class="row">
        <?= Html::submitButton('Opslaan',['class' => 'btn btn-lg btn-default col-sm-10 col-sm-offset-1']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>