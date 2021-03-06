<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Score */

$this->title = 'Bewerk Score: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Bewerk';
?>
<div class="score-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
