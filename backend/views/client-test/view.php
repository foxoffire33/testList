<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ClientTest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Client Testen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'client.name',
            'test.name',
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
