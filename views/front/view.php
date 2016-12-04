<?php
/**
 * Created by PhpStorm.
 * User: r
 * Date: 04.12.16
 * Time: 21:34
 */

/** @var \altiore\recipe\models\Recipe $model */
?>

<div class="container">
    <h1><?= $model->title ?></h1>
    <p><?= $model->description ?></p>

    <div class="card card-block">
        <p class="card-text"><?= $model->text ?></p>
    </div>
</div>
