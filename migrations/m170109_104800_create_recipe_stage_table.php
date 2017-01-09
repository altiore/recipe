<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m170109_104800_create_recipe_stage_table extends Migration
{
    private $table = '{{%recipe_stage}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(null, $this->table, 'created_by');
        $this->createIndex(null, $this->table, 'updated_by');

        $userTable = Yii::$app->getModule('recipe')->userTable;
        $userPrimaryKey = Yii::$app->getModule('recipe')->userPrimaryKey;

        $this->addForeignKey(null, $this->table, 'created_by', $userTable, $userPrimaryKey, 'SET NULL', 'CASCADE');
        $this->addForeignKey(null, $this->table, 'updated_by', $userTable, $userPrimaryKey, 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(null, $this->table, 'updated_by');
        $this->dropForeignKey(null, $this->table, 'created_by');

        $this->dropIndex(null, $this->table, 'created_by');
        $this->dropIndex(null, $this->table, 'updated_by');

        $this->dropTable($this->table);
    }
}
