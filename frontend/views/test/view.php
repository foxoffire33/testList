<?php
use frontend\assetsBundels\viewTest\ViewtestAssetsBundel;
use yii\widgets\DetailView;
use yii\helpers\Html;

$psycholoog = Yii::$app->user->identity->role == 'psycholoog';
if ($psycholoog) {
    ViewtestAssetsBundel::register($this);
}
?>
<div class="col-sm-12">
    <h1>Test: <?= $model->test->name ?></h1>
    <div class="row">
            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created:datetime',
            'client_id' => [
                'attribute' => 'client_id',
                'value' => $model->client->name,
            ],
        ],
    ]) ?>
    </div>
    <div class="row">
        <?php foreach ($model->categories as $category): ?>
            <div class="col-sm-<?= ($psycholoog ? '9' : '12') ?>">
                <?php $category->setClientTestId($model->id); ?>
                <div class="list-group-item disabled"><?= $category->name ?>
                    <?php if (Yii::$app->user->identity->role !== 'behandelaar'): ?>
                        <span class="badge pull-right">
                    <?= $category->categoryScore ?>
                </span>
                    <?php endif; ?>
                </div>
                <?php if (!empty($category->scores)): ?>
                    <div class="list-group">
                        <?php foreach ($category->scores as $score): ?>
                            <div class="list-group-item">
                                <strong><?= $score->antwoord->vraag->text ?></strong>, <?= $score->antwoord->text ?>
                                <?php if (Yii::$app->user->identity->role !== 'behandelaar'): ?>
                                    <span class="badge pull-right">
                                        <?= $score->antwoord->waarde ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($psycholoog): ?>
                <div class="col-sm-3">
                    <?php if (!empty($category->norms)): ?>
                        <lu class="list-group-items">
                            <?php foreach ($category->norms as $norm): ?>
                                <?= Html::a($norm->norm->name . '<span class="badge pull-right">' . $norm->getFormuleResult($model->id) . '/' . $norm->max . '</span>', ['/norm-category/test-summary', 'id' => $category->id, 'testID' => $model->id], [
                                    'class' => 'list-group-item',
                                    'style' => 'padding:4px 7px 4px 7px'
                                ]) ?>
                            <?php endforeach; ?>
                        </lu>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
