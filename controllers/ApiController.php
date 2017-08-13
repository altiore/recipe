<?php

namespace altiore\recipe\controllers;

use altiore\recipe\models\Ingredient;
use altiore\recipe\models\RecipeStage;
use altiore\recipe\models\Unit;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * PageController implements the CRUD actions for Page model.
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [
        ];
    }

    /**
     * @return static[]
     */
    public function actionUnits()
    {
        return Unit::find()->all();
    }

    /**
     * @param $id
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionIngredients($id = null)
    {
        if ($id === null) {
            return Ingredient::find()->all();
        } else {
            return $this->findModel($id)->ingredients;
        }
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
        $model = RecipeStage::find()
            ->with(['ingredients'])
            ->where(['id' => $id])
            ->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
