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
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>


    <div class="col-sm-8">
        <h3>Vraagen</h3>
        <?php if (!empty($model->vraags)): ?>
            <ul>
                <?php foreach ($model->vraags as $vraag): ?>
                    <li>
                        <strong><?= Html::a($vraag->text, ['/vraag/view', 'id' => $vraag->id]); ?></strong>
                        <?php if (!empty($vraag->andwoords)): ?>
                            <ul>
                                <?php foreach ($vraag->andwoords as $andwoord): ?>
                                    <li><?= Html::a($andwoord->text, ['/andwoord/view', 'id' => $andwoord->id]) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="col-sm-4">
        <h3>Vraag toevogen</h3>
        <?php $form = ActiveForm::begin([
            'action' => ['/vraag/create']
        ]); ?>
        <?= $form->field(new Vraag(), 'test_id')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= $form->field(new Vraag(), 'text')->textInput(['placeholder' => $model->getAttributeLabel('text')])->label(false); ?>
        <div class="row">
            <?= Html::submitButton('send',['class' => 'btn btn-lg btn-default col-sm-10 col-sm-offset-1']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
