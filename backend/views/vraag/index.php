<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VraagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vragen';
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
            'category_id' => [
                'attribute' => 'category_id',
                'value' => function ($data) {
                    return $data->category->name;
                }
            ],
            'created:datetime',
            'updated:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
