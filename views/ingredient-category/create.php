<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\IngredientCategory */

$this->title = Yii::t('altioreRecipe', 'Create Ingredient Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Ingredient Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
