<?php

namespace frontend\controllers;

use common\models\NormCategory;
use yii\data\ArrayDataProvider;

class NormCategoryController extends \yii\web\Controller
{
    public function actionTestSummary($id, $testID)
    {
        $count = 0;
        $dataToDisplay = [];
        if (!empty(($categories = NormCategory::findAll(['norm_id' => $id])))) {
            foreach ($categories as $category) {
                $category->category->setClientTestId($testID);
                    $temp = [
                        'id' => $count,
                        'name' => $category->category->name,
                        'normScore' => $category->getFormuleResult($testID),
                        'score' => $category->category->categoryScore,
                        'max' => $category->max,
                    ];
                    $dataToDisplay[$count] = $temp;
                    $count++;
            }
        }
        $dataProvider = new ArrayDataProvider(['allModels' => $dataToDisplay]);
        return $this->render('view', ['dataProvider' => $dataProvider, 'testID' => $testID]);
    }

}