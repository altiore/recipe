<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Recipe */

$this->title = Yii::t('recipe', 'Update {modelClass}: ', [
    'modelClass' => 'Recipe',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipe', 'Recipes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('recipe', 'Update');
?>
<div class="recipe-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
