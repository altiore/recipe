<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170814_202600_add_image_field_to_recipe_category extends Migration
{
    private $tableRecipeCategory = '{{%recipe_category}}';
    private $tableImage = '{{%image}}';

    public function safeUp()
    {
        $this->addColumn($this->tableRecipeCategory, 'image_id', $this->integer());
        $this->createIndex(null, $this->tableRecipeCategory, 'image_id');
        $this->addForeignKey(null, $this->tableRecipeCategory, 'image_id', $this->tableImage, 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(null, $this->tableRecipeCategory, 'image_id');
        $this->dropIndex(null, $this->tableRecipeCategory, 'image_id');
        $this->dropColumn($this->tableRecipeCategory, 'image_id');
    }
}
