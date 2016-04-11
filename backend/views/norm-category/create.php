<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NormCategory */

$this->title = 'Create Norm Category';
$this->params['breadcrumbs'][] = ['label' => 'Norm Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
