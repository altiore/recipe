<?php

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\RecipeCategory */

$this->title = Yii::t('altioreRecipe', 'Update {modelClass}: ', [
    'modelClass' => 'Ingredient',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Recipe Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('altioreRecipe', 'Update');
?>
<div class="ingredient-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
