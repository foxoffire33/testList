<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use common\models\NormCategory;
use common\models\search\NormCategorySearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * NormCategoryController implements the CRUD actions for NormCategory model.
 */
class NormCategoryController extends BackendController
{

    /**
     * Lists all NormCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NormCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NormCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Finds the NormCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NormCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NormCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new NormCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NormCategory();

        if ($model->load(Yii::$app->request->post())) {
            $model->formulles = Yii::$app->request->post('formule', []);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', ['model' => $model, 'formules' => $model->formulles]);
    }

    /**
     * Updates an existing NormCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->formulles = Yii::$app->request->post('formule', []);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $model->norm_id_virtual = (isset($model->norm->name) ? $model->norm->name : $model->norm_id_virtual);
        $model->norm_category_id_virtual = (isset($model->norm->name) ? $model->category->name : $model->norm_category_id_virtual);
        return $this->render('update', ['model' => $model, 'formules' => $model->formulles]);
    }

    /**
     * Deletes an existing NormCategory model.
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
