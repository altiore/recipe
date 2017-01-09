<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170109_191700_create_stage_to_ingredient_link extends Migration
{
    private $tableLink = '{{%recipe_ingredient_unit_link}}';
    private $tableStage = '{{%recipe_stage}}';
    private $tableIngredient = '{{%ingredient}}';
    private $tableUnit = '{{%unit}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableLink, [
            'recipe_stage_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
            'unit_id' => $this->integer()->notNull(),
            'amount' => $this->double()->notNull(),
            'PRIMARY KEY (recipe_stage_id, ingredient_id)'
        ], $tableOptions);

        $this->createIndex(null, $this->tableLink, 'recipe_stage_id');
        $this->createIndex(null, $this->tableLink, 'ingredient_id');
        $this->createIndex(null, $this->tableLink, 'unit_id');

        $this->addForeignKey(null, $this->tableLink, 'recipe_stage_id', $this->tableStage, 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(null, $this->tableLink, 'ingredient_id', $this->tableIngredient, 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey(null, $this->tableLink, 'unit_id', $this->tableUnit, 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(null, $this->tableLink, 'recipe_stage_id');
        $this->dropForeignKey(null, $this->tableLink, 'ingredient_id');
        $this->dropForeignKey(null, $this->tableLink, 'unit_id');

        $this->dropIndex(null, $this->tableLink, 'recipe_stage_id');
        $this->dropIndex(null, $this->tableLink, 'ingredient_id');
        $this->dropIndex(null, $this->tableLink, 'unit_id');

        $this->dropTable($this->tableLink);
    }
}
