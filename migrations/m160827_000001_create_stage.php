<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;

class m160827_000001_create_stage extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stage}}', [
            'recipe_id' => $this->integer()->notNull(),
            'step' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('stage_pk', '{{%stage}}', ['recipe_id', 'step']);

        $this->createIndex(null, '{{%stage}}', 'recipe_id');

        $this->addForeignKey(null, '{{%stage}}', 'recipe_id', '{{%recipe}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%stage}}');
    }
}
