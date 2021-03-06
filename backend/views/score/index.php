<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ScoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="score-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Maak Score', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'test' => [
                'filter' => false,
                'header' => 'Test',
                'value' => function ($data) {
                    return $data->clientTest->test->name;
                }
            ],
            'client' => [
                'filter' => false,
                'header' => 'Client',
                'value' => function ($data) {
                    return $data->clientTest->client->name;
                }
            ],
            'antwoord_id' => [
                'attribute' => 'antwoord_id',
                'value' => function ($data) {
                    return $data->antwoord->text;
                }
            ],
            'created:datetime',
            'updated:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
