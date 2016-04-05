<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use common\models\Behandelaar;
use common\models\search\BehandelaarSearch;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * BehandelaarController implements the CRUD actions for Behandelaar model.
 */
class BehandelaarController extends BackendController
{
    /**
     * Lists all Behandelaar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BehandelaarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Behandelaar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Finds the Behandelaar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Behandelaar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Behandelaar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Behandelaar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Behandelaar();
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
     * Updates an existing Behandelaar model.
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
     * Deletes an existing Behandelaar model.
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
