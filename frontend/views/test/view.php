<?php
use frontend\assetsBundels\viewTest\ViewtestAssetsBundel;
use yii\widgets\DetailView;

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
                                <li class="list-group-item" style="padding:4px 7px 4px 7px"><?= $norm->norm->name ?>
                                    <span class="badge pull-right">
                                        <?= $norm->getFormuleResult($model->id) ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </lu>
                    <?php endif; ?>
                    <div class="row col-sm-12" style="display: none;">
                        <span id="category"><?= $category->categoryScore ?></span> - <span id="selected">0</span> =
                        <span id="total">0</span>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
