<?php

namespace altiore\recipe\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%stage}}".
 *
 * @property integer $recipe_id
 * @property integer $step
 * @property string  $name
 * @property string  $text
 *
 * @property Recipe  $recipe
 */
class Stage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_id', 'step', 'name', 'text'], 'required'],
            [['recipe_id', 'step'], 'integer'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [
                ['recipe_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Recipe::className(),
                'targetAttribute' => ['recipe_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => Yii::t('app', 'Recipe ID'),
            'step'      => Yii::t('app', 'Step'),
            'name'      => Yii::t('app', 'Name'),
            'text'      => Yii::t('app', 'Text'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['id' => 'recipe_id']);
    }
}
