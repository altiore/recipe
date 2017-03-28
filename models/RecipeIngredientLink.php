<?php

namespace altiore\recipe\models;

use Yii;
use yii\base\InvalidParamException;

/**
 * This is the model class for table "{{%recipe_ingredient_unit_link}}".
 *
 * @property integer     $recipe_stage_id
 * @property integer     $ingredient_id
 * @property integer     $unit_id
 * @property double      $amount
 * @property string      $name
 * @property string      $unit
 *
 * @property Ingredient  $ingredient
 * @property RecipeStage $recipeStage
 * @property Unit        $unitModel
 */
class RecipeIngredientLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipe_ingredient_unit_link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_stage_id', 'ingredient_id', 'unit_id', 'amount'], 'required'],
            [['recipe_stage_id', 'ingredient_id', 'unit_id'], 'integer'],
            [['amount'], 'number'],
            [
                ['ingredient_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Ingredient::className(),
                'targetAttribute' => ['ingredient_id' => 'id'],
            ],
            [
                ['recipe_stage_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => RecipeStage::className(),
                'targetAttribute' => ['recipe_stage_id' => 'id'],
            ],
            [
                ['unit_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Unit::className(),
                'targetAttribute' => ['unit_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipe_stage_id' => Yii::t('altioreRecipe', 'Recipe Stage ID'),
            'ingredient_id'   => Yii::t('altioreRecipe', 'Ingredient ID'),
            'unit_id'         => Yii::t('altioreRecipe', 'Unit ID'),
            'amount'          => Yii::t('altioreRecipe', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeStage()
    {
        return $this->hasOne(RecipeStage::className(), ['id' => 'recipe_stage_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitModel()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->ingredient->name;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unitModel->short;
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'name',
            'amount',
            'unit',
        ];
    }

    /**
     * @param RecipeIngredientLink $ingredient
     * @return $this
     */
    public function add(RecipeIngredientLink $ingredient)
    {
        if ($ingredient->ingredient_id !== $this->ingredient_id) {
            throw new InvalidParamException('Parameter not allowed');
        }
        if ($ingredient->unit_id !== $this->unit_id) {
            throw new InvalidParamException('Not implemented yet!');
        }
        $this->amount += $ingredient->amount;

        return $this;
    }
}
