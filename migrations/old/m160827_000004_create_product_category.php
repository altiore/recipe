<?php
namespace altiore\recipe\migrations;

use altiore\base\console\Migration;
use Yii;

class m160827_000004_create_product_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_category}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string()->unique()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(null, '{{%product_category}}', 'category_id');
        $this->createIndex(null, '{{%product_category}}', 'created_by');
        $this->createIndex(null, '{{%product_category}}', 'updated_by');

        /** @var \yii\db\ActiveRecord $userClass */
        $userClass = Yii::$app->getUser()->identityClass;

        $this->addForeignKey(null, '{{%product_category}}', 'category_id', '{{%product_category}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey(null, '{{%product_category}}', 'created_by', $userClass::getTableSchema(), $userClass::primaryKey(), 'SET NULL', 'CASCADE');
        $this->addForeignKey(null, '{{%product_category}}', 'updated_by', $userClass::getTableSchema(), $userClass::primaryKey(), 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_category}}');
    }
}
