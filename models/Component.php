<?php

namespace altiore\recipe\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%component}}".
 *
 * @property integer            $id
 * @property string             $name
 * @property string             $description
 * @property string             $damage
 * @property string             $benefit
 * @property integer            $created_at
 * @property integer            $updated_at
 * @property integer            $created_by
 * @property integer            $updated_by
 *
 * @property Recipe             $createdBy
 * @property Product            $updatedBy
 * @property ProductComponent[] $productComponents
 * @property Product[]          $products
 */
class Component extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%component}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['name'], 'required'],
            [['description', 'damage', 'benefit'], 'string'],
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
            'id'          => Yii::t('app', 'ID'),
            'name'        => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'damage'      => Yii::t('app', 'Damage'),
            'benefit'     => Yii::t('app', 'Benefit'),
            'created_at'  => Yii::t('app', 'Created At'),
            'updated_at'  => Yii::t('app', 'Updated At'),
            'created_by'  => Yii::t('app', 'Created By'),
            'updated_by'  => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Product::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductComponents()
    {
        return $this->hasMany(ProductComponent::className(), ['component_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('{{%product_component}}', ['component_id' => 'id']);
    }
}
