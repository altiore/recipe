<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

/**
 * Class m170109_103534_create_unit_table
 */
class m170109_103534_create_unit_table extends Migration
{
    private $table = '{{%unit}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'short' => $this->string(10)->notNull(),
            'description' => $this->string(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
