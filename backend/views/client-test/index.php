<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ClientTestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Testen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'client_id' => [
                'attribute' => 'client_id',
                'value' => function($data){
                    return $data->client->name;
                }
            ],
            'test_id' => [
                'attribute' => 'test_id',
                'value' => function($data){
                    return $data->test->name;
                }
            ],
            'created:datetime',
            'updated:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
            ],
        ],
    ]); ?>
</div>
