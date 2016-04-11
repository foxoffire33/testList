<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Norms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Norm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'created:datetime',
            'updated:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
