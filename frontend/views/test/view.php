<?php use yii\widgets\DetailView; ?>
<div class="col-sm-12">
    <h1>Test: <?= $model->test->name ?></h1>
    <h4>Client: <?= $model->client->name ?></h4>
    <div class="row">
            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>
    </div>
    <div class="row">
        <?php foreach ($model->categories as $category): ?>
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
        <?php endforeach; ?>
    </div>
</div>