<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use common\models\Antwoord;
use common\models\search\AntwoordSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * AndwoordController implements the CRUD actions for Andwoord model.
 */
class AntwoordController extends BackendController
{

    /**
     * Lists all Andwoord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AntwoordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Andwoord model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Finds the Andwoord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Andwoord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Antwoord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Andwoord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Antwoord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Andwoord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->vraag_id_virtual = (isset($model->vraag->id) ? $model->vraag->text : $model->vraag_id_virtual);
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Andwoord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
