<?php

namespace altiore\recipe\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%unit}}".
 *
 * @property integer            $id
 * @property string             $name
 *
 * @property Ingredient[]       $ingredients
 * @property ProductComponent[] $productComponents
 * @property Unit[]             $unitDivisors
 * @property Unit[]             $unitDividends
 */
class Unit extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%unit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductComponents()
    {
        return $this->hasMany(ProductComponent::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitDivisors()
    {
        return $this->hasMany(Unit::className(), ['id' => 'unit_divisor_id'])
            ->viaTable('{{%unit_conversion}}', ['unit_dividend_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitDividends()
    {
        return $this->hasMany(Unit::className(), ['id' => 'unit_dividend_id'])
            ->viaTable('{{%unit_conversion}}', ['unit_divisor_id' => 'id']);
    }
}
