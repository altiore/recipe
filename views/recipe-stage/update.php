<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\forms\RecipeStageForm */

$this->title = Yii::t('altioreRecipe', 'Update {modelClass}: ', [
    'modelClass' => 'Recipe Stage',
]) . $model->recipeStage->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Recipe Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recipeStage->name, 'url' => ['view', 'id' => $model->recipeStage->id]];
$this->params['breadcrumbs'][] = Yii::t('altioreRecipe', 'Update');
?>
<div class="recipe-stage-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
