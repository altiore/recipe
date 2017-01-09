<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Unit */

$this->title = Yii::t('altioreRecipe', 'Update {modelClass}: ', [
    'modelClass' => 'Unit',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('altioreRecipe', 'Update');
?>
<div class="unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
