<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170119_234100_recipe_stage_link extends Migration
{
    private $tableLink = '{{%recipe_stage_link}}';
    private $tableRecipe = '{{%recipe_stage}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn($this->tableRecipe, 'description', $this->text());

        $this->createTable($this->tableLink, [
            'recipe_id'    => $this->integer()->notNull(),
            'stage_id'     => $this->integer()->notNull(),
            'title'        => $this->string(),
            'include_type' => $this->smallInteger()->notNull()->defaultValue(0),
            'order'        => $this->smallInteger()->notNull(),
            'PRIMARY KEY(recipe_id, stage_id)',
        ], $tableOptions);

        $this->createIndex(null, $this->tableLink, ['recipe_id', 'order'], true);
        $this->createIndex(null, $this->tableLink, 'recipe_id');
        $this->createIndex(null, $this->tableLink, 'stage_id');

        $this->addForeignKey(null, $this->tableLink, 'recipe_id', $this->tableRecipe, 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(null, $this->tableLink, 'stage_id', $this->tableRecipe, 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(null, $this->tableLink, 'recipe_id');
        $this->dropForeignKey(null, $this->tableLink, 'stage_id');

        $this->dropIndex(null, $this->tableLink, 'recipe_id');
        $this->dropIndex(null, $this->tableLink, 'stage_id');
        $this->dropIndex(null, $this->tableLink, ['recipe_id', 'order']);

        $this->dropTable($this->tableLink);

        $this->dropColumn($this->tableRecipe, 'description');
    }
}
