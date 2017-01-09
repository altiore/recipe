<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Ingredient */

$this->title = Yii::t('altioreRecipe', 'Create Ingredient');
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
