<?php
namespace altiore\recipe\forms;

use altiore\recipe\models\Ingredient;
use altiore\recipe\models\RecipeIngredientLink;
use altiore\recipe\models\RecipeStage;
use altiore\recipe\models\Unit;
use yii\base\Model;

class IngredientForm extends Model
{
    public $name;
    public $amount;
    public $unit;

    /**
     * @var RecipeStage
     */
    public $recipeStage;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['amount'], 'double'],
            [['name', 'unit'], 'string', 'max' => 255],
        ];
    }

    public function save()
    {
        $ingredient = Ingredient::findOne(['name' => $this->name]);
        if ($ingredient === null) {
            $ingredient = new Ingredient([
                'name' => $this->name,
            ]);
            if (!$ingredient->validate()) {
                return false;
            }
        }

        $unit = Unit::findOne(['name' => $this->unit]);
        if ($unit === null) {
            $unit = new Unit([
                'name'  => $this->unit,
                'short' => mb_substr($this->unit, 0, 2) . '.',
            ]);
            if (!$unit->validate()) {
                return false;
            }
        }

        $ingredient->save(false);
        $unit->save(false);

        $recipeIngredientLink = new RecipeIngredientLink([
            'recipe_stage_id' => $this->recipeStage->id,
            'ingredient_id'   => $ingredient->id,
            'unit_id'         => $unit->id,
            'amount'          => $this->amount,
        ]);

        return $recipeIngredientLink->save();
    }
}
