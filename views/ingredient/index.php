<?php

use altiore\recipe\models\IngredientCategory;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel altiore\recipe\models\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('altioreRecipe', 'Ingredients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

    <p>
        <?= Html::a(Yii::t('altioreRecipe', 'Create Ingredient'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => IngredientCategory::column(false),
            ],
            'name',
            'description:ntext',
            'created_at:datetime',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
