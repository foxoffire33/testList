<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Test', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location.href = \'view/?id=' . $model->id . '\';'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'client_id' => [
                'attribute' => 'client_id',
                'value' => function ($data) {
                    return $data->client->name;
                }
            ],
            'test_id' => [
                'attribute' => 'test_id',
                'value' => function ($data) {
                    return $data->test->name;
                }
            ],            
            'created:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>
</div>
