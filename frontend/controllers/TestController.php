<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 04-04-16
 * Time: 09:19
 */

namespace frontend\controllers;

use common\models\search\TestSearch;
use common\models\Test;
use Yii;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionJosn($id)
    {
        header('application/json');
        if(!empty(($model = Test::findOne($id)))){
            $returnArray = [];
            foreach($model->vraags as $vragen){

            }
        }
    }

    public function actionView($id)
    {

    }

    public function actionCreate()
    {
        $model = new Test();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

}