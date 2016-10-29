<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model altiore\recipe\models\Recipe */
?>
<div class="recipe-view">

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'text:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value'     => $model->createdBy->username,
            ],
            [
                'attribute' => 'updated_by',
                'value'     => $model->updatedBy->username,
            ],
        ],
    ]) ?>

</div>
