<?php
namespace altiore\recipe\forms;

use altiore\recipe\models\RecipeStage;
use yii\base\Model;

class RecipeStageForm extends Model
{
    public $name;
    public $text;
    public $ingredients;

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
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            ['ingredients', 'safe'],
        ];
    }

    public function save()
    {
        if ($this->validate()) {

            $this->recipeStage->setAttributes($this->attributes);
            if (!$this->recipeStage->save()) {
                return false;
            }

            $this->recipeStage->unlinkAll('ingredients', true);
            foreach ($this->ingredients as $ingredient) {
                $ingredientModel = new IngredientForm([
                    'recipeStage' => $this->recipeStage,
                ]);
                $ingredientModel->setAttributes($ingredient);
                if (!$ingredientModel->save()) {
                    $this->addErrors([
                        'ingredients' => $ingredientModel->getFirstErrors()
                    ]);
                    return false;
                }
            }

            return true;
        }

        return false;
    }
}
