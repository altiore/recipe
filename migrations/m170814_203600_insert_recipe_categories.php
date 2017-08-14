<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170814_203600_insert_recipe_categories extends Migration
{
    private $tableRecipeCategory = '{{%recipe_category}}';

    private $categories = [
        ['Завтраки', ''],
        ['Десерты', ''],
        ['Напитки и смузи', ''],
        ['Главные блюда', ''],
        ['Блюда из мяса и рыбы', ''],
        ['Вегитарианские', ''],
        ['Веганские', ''],
    ];

    public function safeUp()
    {
        $this->batchInsert($this->tableRecipeCategory, ['name', 'description'], $this->categories);
    }

    public function safeDown()
    {
        foreach ($this->categories as $category) {
            $this->delete($this->tableRecipeCategory, [
                'name' => $category[0],
            ]);
        }
    }
}
