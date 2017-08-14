<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\RecipeCategory */

$this->title = Yii::t('altioreRecipe', 'Create Recipe Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Recipe Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
