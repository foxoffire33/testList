<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categorieën', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Bewerk', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Verwijder', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Weet u zekker dat u dit wilt verwijderen',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'test_id' => [
                'attribute' => 'test_id',
                'format' => 'html',
                'value' => Html::a($model->test->name, ['/test/view', 'id' => $model->test->id])
            ],
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
