<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\RecipeStage */

$this->title = Yii::t('altioreRecipe', 'Update {modelClass}: ', [
    'modelClass' => 'Recipe Stage',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Recipe Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('altioreRecipe', 'Update');
?>
<div class="recipe-stage-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
