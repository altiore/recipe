<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170318_170200_add_image_fields extends Migration
{
    private $tableRecipe = '{{%recipe_stage}}';
    private $tableImage = '{{%image}}';

    public function safeUp()
    {
        $this->addColumn($this->tableRecipe, 'image_id', $this->integer());
        $this->createIndex(null, $this->tableRecipe, 'image_id');
        $this->addForeignKey(null, $this->tableRecipe, 'image_id', $this->tableImage, 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(null, $this->tableRecipe, 'image_id');
        $this->dropIndex(null, $this->tableRecipe, 'image_id');
        $this->dropColumn($this->tableRecipe, 'image_id');
    }
}
