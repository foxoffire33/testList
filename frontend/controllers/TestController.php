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
use common\models\search\ClientTestSearch;
use common\models\Test;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TestController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'json', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ClientTestSearch();
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
        throw new NotFoundHttpException();
    }

    public function actionView($id)
    {
        if (!empty(($model = ClientTest::findOne($id)))) {
            return $this->render('view', ['model' => $model]);
        }
        throw new NotFoundHttpException();
    }

    public function actionCreate()
    {
        $scoreModels = [];
        $model = new ClientTest();
        if ($model->load(Yii::$app->request->post())) {
            $count = count(Yii::$app->request->post('Score', []));
            if (count(Test::findOne($model->test_id)->vraags) != $count) {
                $model->addError('test_id', 'Niet alle vragen zijn beandwoord');
            }
            for ($i = 0; $i < $count; $i++) {
                $scoreModels[] = new Score();
            }
            if ($model->validate() && Model::loadMultiple($scoreModels, Yii::$app->request->post()) && Model::validateMultiple($scoreModels)) {
                $model->save(false);

                foreach ($scoreModels as $scoreModel) {
                    $scoreModel->client_test_id = $model->id;
                    $scoreModel->save(false);
                }
                return $this->redirect(['/test/view', 'id' => $model->id]);
            }
        }
        return $this->render('create', ['model' => $model, 'scoreModels' => $scoreModels]);
    }

    public function actionDelete($id)
    {
        if (!empty(($model = ClientTest::findOne($id)))) {
            $model->delete();
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException();
    }

}