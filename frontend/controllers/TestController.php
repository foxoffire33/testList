<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 04-04-16
 * Time: 09:19
 */

namespace frontend\controllers;

use common\models\ClientTest;
use common\models\Score;
use common\models\search\TestSearch;
use common\models\Test;
use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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


    public function actionJson($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty(($model = Test::findOne($id)))) {
            $returnArray = [];
            foreach ($model->vraags as $vraagID => $vraag) {
                $returnArray[$vraagID]['id'] = $vraag->id;
                $returnArray[$vraagID]['text'] = $vraag->text;
                $returnArray[$vraagID]['andwoorden'] = [];
                if (!empty($vraag->andwoords)) {
                    foreach ($vraag->andwoords as $andwoord) {
                        $returnArray[$vraagID]['andwoorden'][] = ['id' => $andwoord->id, 'text' => $andwoord->text];
                    }
                }
            }
            return $returnArray;
        }
    }

    public function actionView($id)
    {
        if(!empty(($model = ClientTest::findOne($id)))){
            return $this->render('view',['model' => $model]);
        }
        throw new NotFoundHttpException();
    }

    public function actionCreate()
    {
        $model = new ClientTest();
        $scoreModels = [];

        if (Yii::$app->request->isPost && ($count = count(Yii::$app->request->post('Score', []))) > 0) {
            $count = count(Yii::$app->request->post('Score', []));
            $scoreModels = [new Score()];
            for ($i = 1; $i < $count; $i++) {
                $scoreModels[] = new Score();
            }
            if ($model->load(['ClientTest' => Yii::$app->request->post('ClientTest')]) && Model::loadMultiple($scoreModels, Yii::$app->request->post())) {
                $modelValidate = $model->validate();
                $scoreModelsValidate = Model::validateMultiple($scoreModels);
                if (($modelValidate && $scoreModelsValidate)) {
                    $model->save(false);
                    foreach ($scoreModels as $scoreModel) {
                        $scoreModel->client_test_id = $model->id;
                        $scoreModel->save(false);
                    }
                    $this->redirect(['/test/view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', ['model' => $model, 'scoreModels' => $scoreModels]);

    }

}