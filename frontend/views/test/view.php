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
            <h4><?= $category->name ?><span class="badge pull-right"><?= $category->categoryScore ?></span></h4>
            <?php if (!empty($category->scores)): ?>
                <ul class="list-group">
                    <?php foreach ($category->scores as $score): ?>
                        <li class="list-group-item">
                            <strong><?= $score->antwoord->vraag->text ?></strong>, <?= $score->antwoord->text ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>