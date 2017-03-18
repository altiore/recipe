<?php

namespace altiore\recipe\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ingredient}}".
 *
 * @property integer            $id
 * @property integer            $category_id
 * @property string             $name
 * @property string             $description
 * @property integer            $created_at
 * @property integer            $updated_at
 * @property integer            $created_by
 * @property integer            $updated_by
 *
 * @property IngredientCategory $category
 * @property User               $createdBy
 * @property User               $updatedBy
 */
class Ingredient extends ActiveRecord
{
    /**
     * @var \altiore\recipe\RecipeModule
     */
    protected $module;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredient}}';
    }

    public function init()
    {
        parent::init();
        $this->module = Yii::$app->getModule('recipe');
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
                'targetClass'     => IngredientCategory::className(),
                'targetAttribute' => ['category_id' => 'id'],
            ],
            [
                ['created_by'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Yii::$app->getUser()->identityClass,
                'targetAttribute' => ['created_by' => $this->module->userPrimaryKey],
            ],
            [
                ['updated_by'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Yii::$app->getUser()->identityClass,
                'targetAttribute' => ['updated_by' => $this->module->userPrimaryKey],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('altioreRecipe', 'ID'),
            'category_id' => Yii::t('altioreRecipe', 'Category'),
            'name'        => Yii::t('altioreRecipe', 'Name'),
            'description' => Yii::t('altioreRecipe', 'Description'),
            'created_at'  => Yii::t('altioreRecipe', 'Created At'),
            'updated_at'  => Yii::t('altioreRecipe', 'Updated At'),
            'created_by'  => Yii::t('altioreRecipe', 'Created By'),
            'updated_by'  => Yii::t('altioreRecipe', 'Updated By'),
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
    public function getCategory()
    {
        return $this->hasOne(IngredientCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Yii::$app->getUser()->identityClass, [$this->module->userPrimaryKey => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Yii::$app->getUser()->identityClass, [$this->module->userPrimaryKey => 'updated_by']);
    }

    /**
     * @return array
     */
    public static function column()
    {
        return static::find()->select(['name'])->indexBy('name')->orderBy(['name' => SORT_ASC])->column();
    }
}
