<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel altiore\recipe\models\RecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('recipe', 'Recipes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-index">

    <p>
        <?= Html::a(Yii::t('recipe', 'Create Recipe'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'text:ntext',
            'is_public',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
