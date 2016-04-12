<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NormCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Norm Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-category-view">

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
            'norm_id' => [
                'attribute' => 'norm_id',
                'value' => $model->norm->name,
            ],
            'category_id' => [
                'attribute' => 'category_id',
                'value' => $model->category->name,
            ],
            'max',
            'formule',
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
