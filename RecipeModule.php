<?php
/**
 * Created by PhpStorm.
 * User: r
 * Date: 29.10.16
 * Time: 19:46
 */

namespace altiore\recipe;

use altiore\recipe\models\Recipe;
use Yii;
use yii\base\Module;
use yii\data\ActiveDataProvider;

/**
 * Class RecipeModule
 *
 * @property Recipe[] $recipes
 */
class RecipeModule extends Module
{
    /**
     * @var string - permission for Rbac module
     */
    public $recipeEditPerm = 'recipeEditPerm';
    /**
     * @var int - page size for pagination in ActiveDataProvider
     */
    public $pageSize = 3;

    public function getRecipes()
    {
        $query = Recipe::find();

        if (Yii::$app->getUser()->getIsGuest() || !Yii::$app->getUser()->can($this->recipeEditPerm)) {
            $query->where(['is_public' => true]);
        }

        return new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
        ]);
    }
}
