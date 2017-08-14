<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel altiore\recipe\models\IngredientCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('altioreRecipe', 'Ingredient Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-category-index">

    <p>
        <?= Html::a(Yii::t('altioreRecipe', 'Create Ingredient Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
