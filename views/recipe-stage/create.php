<?php

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\RecipeStage */

$this->title = Yii::t('altioreRecipe', 'Create Recipe Stage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Recipe Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-stage-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
