<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Andwoord */

$this->title = 'Create Andwoord';
$this->params['breadcrumbs'][] = ['label' => 'Andwoords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="andwoord-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
