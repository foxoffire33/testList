<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClientTest */

$this->title = 'Maak Client Test';
$this->params['breadcrumbs'][] = ['label' => 'Client Testen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
