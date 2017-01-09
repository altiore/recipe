<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;

class m160827_000008_create_product_component extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_component}}', [
            'product_id' => $this->integer(),
            'component_id' => $this->integer(),
            'unit_id' => $this->integer()->notNull(),
            'amount' => $this->double()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('product_component_pk', '{{%product_component}}', ['product_id', 'component_id']);

        $this->createIndex(null, '{{%product_component}}', 'product_id');
        $this->createIndex(null, '{{%product_component}}', 'component_id');
        $this->createIndex(null, '{{%product_component}}', 'unit_id');

        $this->addForeignKey(null, '{{%product_component}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(null, '{{%product_component}}', 'component_id', '{{%component}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey(null, '{{%product_component}}', 'unit_id', '{{%unit}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_component}}');
    }
}
