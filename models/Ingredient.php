<?php

namespace altiore\recipe\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ingredient}}".
 *
 * @property integer $recipe_id
 * @property integer $product_id
 * @property integer $unit_id
 * @property double  $amount
 *
 * @property Product $product
 * @property Recipe  $recipe
 * @property Unit    $unit
 */
class Ingredient extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_id', 'product_id', 'unit_id', 'amount'], 'required'],
            [['recipe_id', 'product_id', 'unit_id'], 'integer'],
            [['amount'], 'number'],
            [
                ['product_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Product::className(),
                'targetAttribute' => ['product_id' => 'id'],
            ],
            [
                ['recipe_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Recipe::className(),
                'targetAttribute' => ['recipe_id' => 'id'],
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
            'recipe_id'  => Yii::t('app', 'Recipe ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'unit_id'    => Yii::t('app', 'Unit ID'),
            'amount'     => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }
}
