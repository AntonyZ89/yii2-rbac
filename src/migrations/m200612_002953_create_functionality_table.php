<?php

namespace antonyz89\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%functionality}}`.
 */
class m200612_002953_create_functionality_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%functionality}}', [
            'id' => $this->primaryKey(),
            'controller_id' => $this->string()->notNull(),

            'rule' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-functionality-controller_id', '{{%functionality}}', 'controller_id');
        $this->addForeignKey('fk-functionality-controller_id', '{{%functionality}}', 'controller_id', '{{%rbac_controller}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%functionality}}');
    }
}
