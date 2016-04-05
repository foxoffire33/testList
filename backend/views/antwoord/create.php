<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Andwoord */

$this->title = 'Maak antwoord';
$this->params['breadcrumbs'][] = ['label' => 'Antwoorden', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="andwoord-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
