<?php

use altiore\recipe\assets\ReactIngredientsComponentAsset;
use altiore\recipe\models\Ingredient;
use altiore\recipe\models\RecipeStage;
use altiore\recipe\models\Unit;
use altiore\yii2\markdown\MarkdownEditor;
use kartik\select2\Select2;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\forms\RecipeStageForm */
/* @var $form yii\widgets\ActiveForm */

ReactIngredientsComponentAsset::register($this);
?>

<div class="recipe-stage-form">

    <?php $form = ActiveForm::begin([
        //'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_published', ['options' => ['class' => 'pull-right']])->checkbox() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'text')->widget(MarkdownEditor::className()) ?>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <?php if (!$model->recipeStage->hasStages()): ?>
      <li role="presentation" class="active"><a href="#ingredients-b" aria-controls="ingredients-b" role="tab" data-toggle="tab">Ingredients</a></li>
    <?php endif; ?>
    <li role="presentation" class="<?=$model->recipeStage->hasStages()?'active': '' ?>"><a href="#stages" aria-controls="stages" role="tab" data-toggle="tab">Stages</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <?php if (!$model->recipeStage->hasStages()): ?>
        <div role="tabpanel" class="tab-pane active" id="ingredients-b">
          <div class="panel panel-default" id="ingredient-panel">
            <div class="panel-body">
                <?php foreach ($model->recipeStage->ingredientModels as $i => $item): ?>
                  <div class="panel panel-default">
                    <button data-index="<?=$i?>" type="button" class="btn btn-default pull-right remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <div class="row">
                        <?= $form->field($item, "[$i]name", ['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
                            'data' => Ingredient::column(),
                            'options' => ['placeholder' => 'Выбери ингредиент ...'],
                        ]); ?>
                        <?= $form->field($item, "[$i]amount", ['options' => ['class' => 'col-md-3']])->textInput(); ?>
                        <?= $form->field($item, "[$i]unit", ['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
                            'data' => Unit::column(),
                            'options' => ['placeholder' => 'Единица измерения ...'],
                        ]); ?>
                    </div>
                  </div>
                <?php endforeach; ?>
                <?php $count = count($model->recipeStage->ingredientModels); ?>
                <?php for ($i = $count; $i < $count + 5; $i++): ?>
                  <div class="panel panel-default">
                    <button data-index="<?=$i?>" type="button" class="btn btn-default pull-right remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <div class="row">
                        <?php $item = new \altiore\recipe\forms\IngredientForm(); ?>
                        <?= $form->field($item, "[$i]name", ['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
                            'data' => Ingredient::column(),
                            'options' => ['placeholder' => 'Выбери ингредиент ...'],
                        ]); ?>
                        <?= $form->field($item, "[$i]amount", ['options' => ['class' => 'col-md-3']])->textInput(); ?>
                        <?= $form->field($item, "[$i]unit", ['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
                            'data' => Unit::column(),
                            'options' => ['placeholder' => 'Единица измерения ...'],
                        ]); ?>
                    </div>
                  </div>
                <?php endfor; ?>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-info" role="alert">Нужно удалить все стадии, чтоб добавить ингредиенты непосредственно в рецепт. Иначе, ингредиенты расчитаются автоматически для данного рецепта</div>
      <?php endif; ?>

    <div role="tabpanel" class="tab-pane <?=$model->recipeStage->hasStages()?'active': '' ?>" id="stages">
      <div class="panel panel-default" id="ingredient-panel">
        <div class="panel-body">
            <?php foreach ($model->recipeStage->stages as $i => $item): ?>
              <div class="panel panel-default col-md-7">
                <button data-index="<?=$i?>" type="button" class="btn btn-default pull-right remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                <div class="row">
                    <?= $form->field($item, "[$i]id", ['options' => ['class' => 'col-md-10']])->widget(Select2::classname(), [
                        'data' => RecipeStage::column(),
                        'options' => ['placeholder' => 'Выбери стадию ...'],
                    ]); ?>
                </div>
              </div>
            <?php endforeach; ?>
            <?php $count = count($model->recipeStage->stages); ?>
            <?php for ($i = $count; $i < $count + 3; $i++): ?>
              <div class="panel panel-default col-md-7">
                <button data-index="<?=$i?>" type="button" class="btn btn-default pull-right remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                <div class="row">
                    <?php $item = new RecipeStage(); ?>
                    <?= $form->field($item, "[$i]id", ['options' => ['class' => 'col-md-10']])->widget(Select2::classname(), [
                        'data' => RecipeStage::column(),
                        'options' => ['placeholder' => 'Выбери стадию ...'],
                    ]); ?>
                </div>
              </div>
            <?php endfor; ?>
        </div>
    </div>
  </div>

    <div class="form-group">
        <?= Html::submitButton($model->recipeStage->isNewRecord ? Yii::t('altioreRecipe', 'Create') : Yii::t('altioreRecipe', 'Update'), ['class' => $model->recipeStage->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(<<<JS
    $('#ingredient-panel .panel-body').on('click', '.remove', function(e) {
        $(this).parent().remove();
    });
JS
);
