<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VraagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vraags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vraag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vraag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'text',
            'test_id' => [
                'attribute' => 'test_id',
                'value' => function ($data) {
                    return $data->test->name;
                }
            ],
            'created:datetime',
            'updated:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
