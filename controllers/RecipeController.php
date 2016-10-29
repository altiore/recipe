<?php
/**
 * Created by PhpStorm.
 * User: r
 * Date: 29.10.16
 * Time: 19:47
 */

namespace altiore\recipe\controllers;

use yii\web\Controller;

class RecipeController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent('test');
    }
}
