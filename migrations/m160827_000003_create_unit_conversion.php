<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;

class m160827_000003_create_unit_conversion extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%unit_conversion}}', [
            'unit_dividend_id' => $this->integer()->notNull(),
            'unit_divisor_id' => $this->integer()->notNull(),
            'quotient' => $this->double()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('unit_conversion_pk', '{{%unit_conversion}}', ['unit_dividend_id', 'unit_divisor_id']);

        $this->createIndex(null, '{{%unit_conversion}}', 'unit_dividend_id');
        $this->createIndex(null, '{{%unit_conversion}}', 'unit_divisor_id');

        $this->addForeignKey(null, '{{%unit_conversion}}', 'unit_dividend_id', '{{%unit}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey(null, '{{%unit_conversion}}', 'unit_divisor_id', '{{%unit}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%unit_conversion}}');
    }
}
