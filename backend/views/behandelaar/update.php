<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Behandelaar */

$this->title = 'Bewerk behandelaar: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Behandelaars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Bewerk';
?>
<div class="behandelaar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'user' => $user]) ?>

</div>
