<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Ingredient */

$this->title = Yii::t('altioreRecipe', 'Update {modelClass}: ', [
    'modelClass' => 'Ingredient',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('altioreRecipe', 'Update');
?>
<div class="ingredient-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
