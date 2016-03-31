<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ClientTest */

$this->title = 'Update Client Test: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Client Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
