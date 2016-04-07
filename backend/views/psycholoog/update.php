<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Psycholoog */

$this->title = 'Update Psycholoog: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Psycholoogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="psycholoog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'user' => $user]) ?>

</div>
