<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Unit */

$this->title = Yii::t('altioreRecipe', 'Create Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('altioreRecipe', 'Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
