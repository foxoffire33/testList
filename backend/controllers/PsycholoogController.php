<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use common\models\Psycholoog;
use common\models\search\PsycholoogSearch;
use Yii;
use yii\web\NotFoundHttpException;
use common\models\User;

/**
 * PsycholoogController implements the CRUD actions for Psycholoog model.
 */
class PsycholoogController extends BackendController
{

    /**
     * Lists all Psycholoog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PsycholoogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Psycholoog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Finds the Psycholoog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Psycholoog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Psycholoog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Psycholoog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Psycholoog();
        $user = new User();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            if ($model->validate() && $user->validate()) {
                $user->save(false);

                $model->user_id = $user->id;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', ['model' => $model, 'user' => $user]);
    }

    /**
     * Updates an existing Psycholoog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = $model->user;

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            if ($user->save() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', ['model' => $model, 'user' => $user]);
    }

    /**
     * Deletes an existing Psycholoog model.
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
