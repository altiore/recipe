<?php

namespace altiore\recipe\models;

use yii\db\ActiveRecord;
use altiore\base\models\Image;

/**
 * This is the model class for table "{{%recipe_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $image_id
 *
 * @property RecipeStage[] $recipes
 */
class RecipeCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipe_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['image_id'], 'safe'],
            [['description'], 'string'],
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
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes()
    {
        return $this->hasMany(RecipeStage::className(), ['id' => 'recipe_stage_id'])
            ->viaTable('{{%recipe_stage_category_link}}', ['recipe_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }
}
