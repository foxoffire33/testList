<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Behandelaar */

$this->title = 'Maak behandelaar';
$this->params['breadcrumbs'][] = ['label' => 'Behandelaars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behandelaar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'user' => $user]) ?>

</div>
