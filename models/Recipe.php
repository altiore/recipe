<?php

namespace altiore\recipe\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%recipe}}".
 *
 * @property integer      $id
 * @property string       $title
 * @property string       $description
 * @property string       $text
 * @property boolean      $is_public
 * @property integer      $created_at
 * @property integer      $updated_at
 * @property integer      $created_by
 * @property integer      $updated_by
 *
 * @property Component[]  $components
 * @property Ingredient[] $ingredients
 * @property Product[]    $products
 * @property User         $createdBy
 * @property User         $updatedBy
 * @property Stage[]      $stages
 */
class Recipe extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['title'], 'required'],
            [['text', 'description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['is_public'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'title'       => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'text'        => Yii::t('app', 'Text'),
            'is_public'   => Yii::t('app', 'Is Public'),
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
    public function getComponents()
    {
        return $this->hasMany(Component::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('{{%ingredient}}', ['recipe_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStages()
    {
        return $this->hasMany(Stage::className(), ['recipe_id' => 'id']);
    }
}
