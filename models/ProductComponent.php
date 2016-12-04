<?php

namespace altiore\recipe\models;

use Yii;

/**
 * This is the model class for table "{{%product_component}}".
 *
 * @property integer   $product_id
 * @property integer   $component_id
 * @property integer   $unit_id
 * @property double    $amount
 *
 * @property Component $component
 * @property Product   $product
 * @property Unit      $unit
 */
class ProductComponent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_component}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'component_id', 'unit_id', 'amount'], 'required'],
            [['product_id', 'component_id', 'unit_id'], 'integer'],
            [['amount'], 'number'],
            [
                ['component_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Component::className(),
                'targetAttribute' => ['component_id' => 'id'],
            ],
            [
                ['product_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Product::className(),
                'targetAttribute' => ['product_id' => 'id'],
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
            'product_id'   => Yii::t('app', 'Product ID'),
            'component_id' => Yii::t('app', 'Component ID'),
            'unit_id'      => Yii::t('app', 'Unit ID'),
            'amount'       => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
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
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }
}
