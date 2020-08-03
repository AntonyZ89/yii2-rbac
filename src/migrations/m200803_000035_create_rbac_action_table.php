<?php

namespace antonyz89\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_action}}`.
 */
class m200803_000035_create_rbac_action_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rbac_action}}', [
            'id' => $this->string()->notNull(),
            'controller_id' => $this->string()->notNull(),

            'route' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('pk-rbac_action-id', '{{%rbac_action}}', 'id');

        $this->createIndex('idx-rbac_action-rbac_controller_id', '{{%rbac_action}}', 'controller_id');
        $this->addForeignKey('fk-rbac_action-rbac_controller_id', '{{%rbac_action}}', 'controller_id', '{{%rbac_controller}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rbac_action}}');
    }
}
