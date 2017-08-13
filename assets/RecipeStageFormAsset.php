<?php
namespace altiore\recipe\assets;

use yii\web\AssetBundle;

/**
 * Class RecipeStageFormAsset
 * @package altiore\recipe\assets
 */
class RecipeStageFormAsset extends AssetBundle
{
    public $sourcePath = '@recipe_resources';
    public $css = [
        'css/index.css',
    ];
    public $js = [
        'js/index.js'
    ];
}
