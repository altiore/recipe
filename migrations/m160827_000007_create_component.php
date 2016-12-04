<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m160827_000007_create_component extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%component}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'description' => $this->text(),
            'damage' => $this->text(),
            'benefit' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(null, '{{%component}}', 'created_by');
        $this->createIndex(null, '{{%component}}', 'updated_by');

        /** @var \yii\db\ActiveRecord $userClass */
        $userClass = Yii::$app->getUser()->identityClass;

        $this->addForeignKey(null, '{{%component}}', 'created_by', $userClass::getTableSchema(), $userClass::primaryKey(), 'SET NULL', 'CASCADE');
        $this->addForeignKey(null, '{{%component}}', 'updated_by', $userClass::getTableSchema(), $userClass::primaryKey(), 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%component}}');
    }
}
