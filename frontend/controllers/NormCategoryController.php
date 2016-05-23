<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\ClientTest;
use yii\data\ArrayDataProvider;

class NormCategoryController extends \yii\web\Controller
{
    public function actionTestSummary($id, $testID)
    {
        $count = 0;
        $dataToDisplay = [];
        if (!empty(($category = Category::findOne($id)))) {
            $category->setClientTestId($testID);
                foreach ($category->norms as $norm) {
                    $temp = [
                        'id' => $count,
                        'name' => $norm->norm->name,
                        'normScore' => $norm->getFormuleResult($testID),
                        'score' => $category->categoryScore,
                        'max' => $norm->max,
                    ];
                    $dataToDisplay[$count] = $temp;
                    $count++;
                }
            $dataProvider = new ArrayDataProvider(['allModels' => $dataToDisplay]);
        }
        return $this->render('view', ['dataProvider' => $dataProvider, 'model' => $category]);
    }

}