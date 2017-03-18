<?php

namespace altiore\recipe\models;

use altiore\base\contract\ImageSavableInterface;
use altiore\base\models\Image;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%recipe_stage}}".
 *
 * @property integer                $id
 * @property string                 $name
 * @property string                 $imagePath
 * @property integer                $image_id
 * @property string                 $text
 * @property integer                $created_at
 * @property integer                $updated_at
 * @property integer                $created_by
 * @property integer                $updated_by
 * @property boolean                $is_published
 *
 * @property User                   $createdBy
 * @property User                   $updatedBy
 * @property RecipeIngredientLink[] $ingredients
 * @property Image                  $image
 * @property RecipeStage[]          $stages
 */
class RecipeStage extends ActiveRecord implements ImageSavableInterface
{
    const IMAGE_FOLDER = 'recipe-stage';

    /**
     * @var \altiore\recipe\RecipeModule
     */
    protected $module;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipe_stage}}';
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
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'image_id'], 'safe'],
            [['name', 'text'], 'required'],
            [['is_published'], 'boolean'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [
                ['created_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Yii::$app->getUser()->identityClass,
                'targetAttribute' => ['created_by' => $this->module->userPrimaryKey],
            ],
            [
                ['updated_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Yii::$app->getUser()->identityClass,
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
            'id' => Yii::t('altioreRecipe', 'ID'),
            'name' => Yii::t('altioreRecipe', 'Name'),
            'text' => Yii::t('altioreRecipe', 'Text'),
            'created_at' => Yii::t('altioreRecipe', 'Created At'),
            'updated_at' => Yii::t('altioreRecipe', 'Updated At'),
            'created_by' => Yii::t('altioreRecipe', 'Created By'),
            'updated_by' => Yii::t('altioreRecipe', 'Updated By'),
            'is_published' => Yii::t('altioreRecipe', 'Published'),
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
     * @return string
     */
    public function getImagePath()
    {
        return implode('/', [static::IMAGE_FOLDER, $this->id]);
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
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(RecipeIngredientLink::class, ['recipe_stage_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStages()
    {
        return $this->hasMany(static::class, ['id' => 'stage_id'])
            ->viaTable('{{%recipe_stage_link}}', ['recipe_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function column()
    {
        return static::find()->select(['name'])->indexBy('id')->orderBy(['name' => SORT_ASC])->column();
    }

    /**
     * @return bool
     */
    public function hasStages()
    {
        return (boolean) $this->getStages()->count();
    }
}
