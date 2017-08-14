<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;

class m170814_191400_create_recipe_category extends Migration
{
    private $tableRecipeCategory = '{{%recipe_category}}';
    private $tableRecipe = '{{%recipe_stage}}';
    private $tableRecipeCategoryLink = '{{%recipe_stage_category_link}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableRecipeCategory, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'description' => $this->text(),
        ], $tableOptions);

        $this->createTable($this->tableRecipeCategoryLink, [
            'recipe_stage_id' => $this->integer()->notNull(),
            'recipe_category_id' => $this->integer()->notNull(),
            'order' => $this->integer(),
            'PRIMARY KEY (recipe_stage_id, recipe_category_id)'
        ], $tableOptions);


        $this->createIndex(null, $this->tableRecipeCategoryLink, 'recipe_stage_id');
        $this->createIndex(null, $this->tableRecipeCategoryLink, 'recipe_category_id');

        $this->addForeignKey(null, $this->tableRecipeCategoryLink, 'recipe_stage_id', $this->tableRecipe, 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(null, $this->tableRecipeCategoryLink, 'recipe_category_id', $this->tableRecipeCategory, 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(null, $this->tableRecipeCategoryLink, 'recipe_stage_id');
        $this->dropForeignKey(null, $this->tableRecipeCategoryLink, 'recipe_category_id');

        $this->dropIndex(null, $this->tableRecipeCategoryLink, 'recipe_stage_id');
        $this->dropIndex(null, $this->tableRecipeCategoryLink, 'recipe_category_id');

        $this->dropTable($this->tableRecipeCategoryLink);
        $this->dropTable($this->tableRecipeCategory);
    }
}
