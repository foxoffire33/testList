<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Psycholoog */

$this->title = 'Create Psycholoog';
$this->params['breadcrumbs'][] = ['label' => 'Psycholoogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psycholoog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'user' => $user]) ?>

</div>
