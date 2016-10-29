<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;

class m160827_000006_create_ingredient extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ingredient}}', [
            'recipe_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'unit_id' => $this->integer()->notNull(),
            'amount' => $this->double()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('ingredient_pk', '{{%ingredient}}', ['recipe_id', 'product_id']);

        $this->createIndex(null, '{{%ingredient}}', 'recipe_id');
        $this->createIndex(null, '{{%ingredient}}', 'product_id');
        $this->createIndex(null, '{{%ingredient}}', 'unit_id');

        $this->addForeignKey(null, '{{%ingredient}}', 'recipe_id', '{{%recipe}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(null, '{{%ingredient}}', 'product_id', '{{%product}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey(null, '{{%ingredient}}', 'unit_id', '{{%unit}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%ingredient}}');
    }
}
