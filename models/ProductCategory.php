<?php

namespace altiore\recipe\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_category}}".
 *
 * @property integer           $id
 * @property integer           $category_id
 * @property string            $name
 * @property string            $description
 * @property integer           $created_at
 * @property integer           $updated_at
 * @property integer           $created_by
 * @property integer           $updated_by
 *
 * @property Product[]         $products
 * @property ProductCategory   $category
 * @property ProductCategory[] $productCategories
 * @property User              $createdBy
 * @property User              $updatedBy
 */
class ProductCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['category_id'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [
                ['category_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => ProductCategory::className(),
                'targetAttribute' => ['category_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name'        => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Yii::$app->getUser()->identityClass, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Yii::$app->getUser()->identityClass, ['id' => 'updated_by']);
    }
}
