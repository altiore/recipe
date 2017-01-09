<?php

use altiore\recipe\assets\ReactIngredientsComponentAsset;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\RecipeStage */
/* @var $form yii\widgets\ActiveForm */

ReactIngredientsComponentAsset::register($this);
?>

<div class="recipe-stage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(Redactor::className(), [
        'clientOptions' => [
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ])
    ?>

    <div id="ingredients"></div>

    <?php ActiveForm::end(); ?>

</div>
