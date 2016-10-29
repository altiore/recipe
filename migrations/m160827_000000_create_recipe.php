<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;

class m160827_000000_create_recipe extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%recipe}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'description' => $this->text(),
            'text'        => $this->text(),
            'is_public'   => $this->boolean()->notNull()->defaultValue(false),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'created_by'  => $this->integer(),
            'updated_by'  => $this->integer(),
        ], $tableOptions);

        $this->createIndex(null, '{{%recipe}}', 'created_by');
        $this->createIndex(null, '{{%recipe}}', 'updated_by');

        $this->addForeignKey(null, '{{%recipe}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey(null, '{{%recipe}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%recipe}}');
    }
}
