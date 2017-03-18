<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170318_211500_create_recipe_table extends Migration
{
    private $tableRecipe = '{{%recipe_stage}}';

    public function safeUp()
    {
        $this->addColumn($this->tableRecipe, 'is_published', $this->boolean());
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableRecipe, 'is_published');
    }
}
