<?php

namespace altiore\recipe\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%unit}}".
 *
 * @property integer $id
 * @property string  $name
 * @property string  $short
 * @property string  $description
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
            [['name', 'short'], 'required'],
            [['name'], 'unique'],
            [['name', 'description'], 'string', 'max' => 255],
            [['short'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('altioreRecipe', 'ID'),
            'name'        => Yii::t('altioreRecipe', 'Name'),
            'short'       => Yii::t('altioreRecipe', 'Short'),
            'description' => Yii::t('altioreRecipe', 'Description'),
        ];
    }

    /**
     * @return array
     */
    public static function column()
    {
        return static::find()->select(['name'])->indexBy('short')->orderBy(['name' => SORT_ASC])->column();
    }
}
