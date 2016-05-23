<?php

namespace frontend\controllers;

use common\models\ClientTest;

class NormCategoryController extends \yii\web\Controller
{
    public function actionTestSummary($testID)
    {
        $count = 0;
        $dataToDisplay = [];
        if (!empty(($test = ClientTest::findOne($testID))) && !empty($test->categories)) {
            foreach ($test->categories as $category) {
                $category->setClientTestId($test->id);
                foreach ($category->norms as $norm) {
                    $temp = [
                        'name' => $norm->norm->name,
                        'normScore' => $norm->getFormuleResult($test->id),
                        'score' => $category->categoryScore,
                        'max' => $norm->max,
                    ];
                    $dataToDisplay[$count] = $temp;
                    $count++;
                }
            }
        }
        return $this->render('view', ['arrayWithData' => $dataToDisplay]);
    }

}