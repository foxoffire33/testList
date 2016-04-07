<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Psycholoog */

$this->title = 'Bewerk psycholoog: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Psycholoogen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Bewerk';
?>
<div class="psycholoog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'user' => $user]) ?>

</div>
