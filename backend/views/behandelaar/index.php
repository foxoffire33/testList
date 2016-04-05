<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BehandelaarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Behandelaars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="behandelaar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Maak Behandelaar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'last_name',
            'user_id' => [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->username;
                }
            ],
            'created:datetime',
             'updated:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
