<?php

namespace antonyz89\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_controller}}`.
 */
class m200612_002952_create_rbac_controller_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rbac_controller}}', [
            'id' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('pk-rbac_controller-id', '{{%rbac_controller}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rbac_controller}}');
    }
}
