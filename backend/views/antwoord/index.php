<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AndwoordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Antwoorden';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="andwoord-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Maak antwoord', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location.href = \'antwoord/view/?id=' . $model->id . '\';'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'text',
            'vraag_id' => [
                'attribute' => 'vraag_id',
                'value' => function ($data) {
                    return $data->vraag->text;
                }
            ],
            'created:datetime',
            'updated:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}'
            ],
        ],
    ]); ?>
</div>
