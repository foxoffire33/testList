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
            'score' => [
                'label' => 'Score',
                'value' => count($model->scores)
            ],
        ],
    ]) ?>
    </div>
    <div class="row">
        <?php if (isset($model->scores)): ?>
            <ul class="list-group">
                <?php foreach ($model->scores as $score): ?>
                    <li class="list-group-item">
                        <strong><?=  $score->andwoord->vraag->text ?></strong>, <?=  $score->andwoord->text ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>