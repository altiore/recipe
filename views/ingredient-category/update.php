<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\IngredientCategory */

$this->title = Yii::t('altioreRecipe', 'Update {modelClass}: ', [
    'modelClass' => 'Ingredient Category',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Ingredient Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('altioreRecipe', 'Update');
?>
<div class="ingredient-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
