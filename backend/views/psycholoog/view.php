<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Psycholoog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Psycholoogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psycholoog-view">

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
            'user.username',
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
