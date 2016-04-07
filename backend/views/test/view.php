<?php

use common\models\Category;
use common\models\Vraag;
use yii\helpers\ArrayHelper;
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


        <?php if (!empty($model->categories)): ?>
            <?php foreach ($model->categories as $category): ?>
                <div class="list-group-item disabled"><?= $category->name ?><span
                        class="badge pull-right"><?= count($category->vragen) ?></span></div>
                <?php if (!empty($category->vragen)): ?>
                    <div class="list-group">
                        <?php foreach ($category->vragen as $vraag): ?>
                            <div class="list-group-item">
                                <div
                                    class="list-group-item disabled"><?= Html::a($vraag->text, ['/vraag/view', 'id' => $vraag->id]); ?>
                                    <span class="badge pull-right"><?= count($vraag->antwoorden) ?></span></div>
                                <div class="list-group">
                                    <?php foreach ($vraag->antwoorden as $andwoord): ?>
                                        <div
                                            class="list-group-item"><?= Html::a($andwoord->text, ['/andwoord/view', 'id' => $andwoord->id]) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="col-sm-4">
        <h3>Vraag toevoegen</h3>
        <?php $form = ActiveForm::begin([
            'action' => ['/vraag/create']
        ]); ?>
        <?= $form->field(new Vraag(), 'test_id')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= $form->field(new Vraag(), 'category_id')->dropDownList(ArrayHelper::map(Category::find()->where(['test_id' => $model->id])->all(), 'id', 'name')) ?>
        <?= $form->field(new Vraag(), 'text')->textInput(['placeholder' => $model->getAttributeLabel('text')])->label(false); ?>
        <div class="row">
            <?= Html::submitButton('Opslaan',['class' => 'btn btn-lg btn-default col-sm-10 col-sm-offset-1']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
