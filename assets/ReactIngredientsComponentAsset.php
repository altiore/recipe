<?php

namespace altiore\recipe\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ReactIngredientsComponentAsset extends AssetBundle
{
    public $sourcePath = '@recipe_resources';
    public $css = [
        'https://fonts.googleapis.com/icon?family=Material+Icons',
    ];
    public $js = [
        'polyfill.js',
        'ingredients.js',
    ];
}
