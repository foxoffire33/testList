<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use Yii;
use common\models\ClientTest;
use common\models\search\ClientTestSearch;
use yii\web\NotFoundHttpException;

/**
 * ClientTestController implements the CRUD actions for ClientTest model.
 */
class ClientTestController extends BackendController
{

    /**
     * Lists all ClientTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientTestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientTest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClientTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*   public function actionCreate()
       {
           $model = new ClientTest();

           if ($model->load(Yii::$app->request->post()) && $model->save()) {
               return $this->redirect(['view', 'id' => $model->id]);
           } else {
               return $this->render('create', [
                   'model' => $model,
               ]);
           }
       }

       public function actionUpdate($id)
       {
           $model = $this->findModel($id);

           if ($model->load(Yii::$app->request->post()) && $model->save()) {
               return $this->redirect(['view', 'id' => $model->id]);
           } else {
               return $this->render('update', [
                   'model' => $model,
               ]);
           }
       }*/

    /**
     * Deletes an existing ClientTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClientTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientTest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
