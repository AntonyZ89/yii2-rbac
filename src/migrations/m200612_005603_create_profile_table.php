<?php

namespace antonyz89\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m200612_005603_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }
}
