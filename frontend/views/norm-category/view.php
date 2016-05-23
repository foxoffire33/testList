<div class="row">
    <?= yii\helpers\Html::a('Naar test', ['/test/view', 'id' => $testID], ['class' => 'btn btn-success']); ?>
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