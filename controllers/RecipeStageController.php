<?php

namespace altiore\recipe\controllers;

use altiore\recipe\forms\RecipeStageForm;
use backend\controllers\BaseController;
use Yii;
use altiore\recipe\models\RecipeStage;
use altiore\recipe\models\RecipeStageSearch;
use yii\web\NotFoundHttpException;

/**
 * RecipeStageController implements the CRUD actions for RecipeStage model.
 */
class RecipeStageController extends BaseController
{
    /**
     * Lists all RecipeStage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecipeStageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RecipeStage model.
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
     * Creates a new RecipeStage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecipeStage();

        $formModel = new RecipeStageForm([
            'recipeStage' => $model,
        ]);
        if ($formModel->load(Yii::$app->request->post()) && $formModel->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $formModel,
            ]);
        }
    }

    /**
     * Updates an existing RecipeStage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $formModel = new RecipeStageForm([
            'recipeStage' => $model,
        ]);
        if ($formModel->load(Yii::$app->request->post()) && $formModel->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $formModel,
            ]);
        }
    }

    /**
     * Deletes an existing RecipeStage model.
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
     * @param $id
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionIngredients($id)
    {
        $model = $this->findModel($id);

        return ['ingredients' => $model->ingredients];
    }

    /**
     * Finds the RecipeStage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecipeStage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecipeStage::find()->with(['ingredients'])->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
