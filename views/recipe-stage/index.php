<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel altiore\recipe\models\RecipeStageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('altioreRecipe', 'Recipe Stages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-stage-index">

    <p>
        <?= Html::a(Yii::t('altioreRecipe', 'Create Recipe Stage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'created_at:datetime',
            //'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
