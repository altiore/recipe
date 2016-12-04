<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Recipe */

$this->title = Yii::t('recipe', 'Create Recipe');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipe', 'Recipes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
