<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\models\Andwoord;

/* @var $this yii\web\View */
/* @var $model common\models\Vraag */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vraags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vraag-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'text',
            'test.name' => [
                'attribute' => 'test.name',
                'format' => 'html',
                'value' => Html::a($model->test->name, ['/test/view', 'id' => $model->test->id])
            ],
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
<div class="col-sm-8">
    <h3>Andwoorden</h3>
    <?php if (!empty($model->antwoorden)): ?>
    <ul>
        <?php foreach ($model->antwoorden as $andwoord): ?>
            <li><?= Html::a($andwoord->text, ['/andwoord/view', 'id' => $andwoord->id]) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<div class="col-sm-4">
    <h3>andwoord toevogen</h3>
    <?php $form = ActiveForm::begin([
        'action' => ['/andwoord/create']
    ]); ?>
    <?= $form->field(new Andwoord(), 'vraag_id')->hiddenInput(['value' => $model->id])->label(false) ?>
    <?= $form->field(new Andwoord(), 'text')->textInput(['placeholder' => $model->getAttributeLabel('text')])->label(false); ?>
    <div class="row">
        <?= Html::submitButton('send',['class' => 'btn btn-lg btn-default col-sm-10 col-sm-offset-1']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>