<?php

namespace altiore\recipe\models;

use Yii;

/**
 * This is the model class for table "{{%ingredient_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Ingredient[] $ingredients
 */
class IngredientCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('altioreRecipe', 'ID'),
            'name' => Yii::t('altioreRecipe', 'Name'),
            'description' => Yii::t('altioreRecipe', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['category_id' => 'id']);
    }

    /**
     * @param bool $addNull
     *
     * @return array
     */
    public static function column($addNull = true)
    {
        $result = static::find()
            ->select(['name'])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
        if ($addNull) {
            $result[null] = 'Без категории';
        }
        return $result;
    }
}
