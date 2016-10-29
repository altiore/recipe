<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'title',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'description',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'is_public',
        'format'    => 'boolean',
        'filter'    => [
            'No',
            'Yes',
        ],
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'created_at',
        'format'    => 'datetime',
    ],
    [
        'class'     => \kartik\grid\DataColumn::class,
        'attribute' => 'updated_at',
        'format'    => 'datetime',
    ],
    [
        'class'     => \kartik\grid\DataColumn::class,
        'attribute' => 'created_by',
        'value'     => function ($model) {
            /** @var \altiore\recipe\models\Recipe $model */
            return $model->updatedBy->username;
        },
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'updated_by',
        'value'     => function ($model) {
            /** @var \altiore\recipe\models\Recipe $model */
            return $model->updatedBy->username;
        },
    ],
    [
        'class'         => 'kartik\grid\ActionColumn',
        'dropdown'      => false,
        'vAlign'        => 'middle',
        'urlCreator'    => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions'   => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role'                 => 'modal-remote',
            'title'                => 'Delete',
            'data-confirm'         => false,
            'data-method'          => false,// for overide yii data api
            'data-request-method'  => 'post',
            'data-toggle'          => 'tooltip',
            'data-confirm-title'   => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item',
        ],
    ],

];
