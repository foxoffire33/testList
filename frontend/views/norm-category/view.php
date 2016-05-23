<div class="row">
    <h1><?= $model->name ?></h1>
</div>
<div class="row">
    <?= yii\helpers\Html::a('Naar test',['/test/view','id' => $model->test->id],['class' => 'btn btn-success']); ?>
</div>
<div class="row">
<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'normScore',
        'score',
        'max'
    ],
]) ?>
</div>