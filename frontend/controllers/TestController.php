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
            if (!empty($model->categories)) {
                foreach ($model->categories as $categorieID => $category) {
                    $returnArray[$categorieID]['name'] = $category->name;
                    $returnArray[$categorieID]['vragen'] = [];
                    if (!empty($category->vragen)) {
                        foreach ($category->vragen as $vraagID => $vraag) {
                            $returnArray[$categorieID]['vragen'][$vraagID]['id'] = $vraag->id;
                            $returnArray[$categorieID]['vragen'][$vraagID]['text'] = $vraag->text;
                            $returnArray[$categorieID]['vragen'][$vraagID]['antwoorden'] = [];
                            if (!empty($vraag->antwoorden)) {
                                foreach ($vraag->antwoorden as $andwoord) {
                                    $returnArray[$categorieID]['vragen'][$vraagID]['antwoorden'][] = [
                                        'id' => $andwoord->id,
                                        'text' => $andwoord->text
                                    ];
                                }
                            }
                        }
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
            for ($i = 0; $i < $count; $i++) {
                $scoreModels[] = new Score();
            }
            if ($model->validate() && Model::loadMultiple($scoreModels, ['Score' => array_values(Yii::$app->request->post('Score', []))]) && Model::validateMultiple($scoreModels)) {
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