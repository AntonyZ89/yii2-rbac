<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_block_rbac_action}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rbac_block}}`
 * - `{{%rbac_action}}`
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class m200803_000036_create_junction_table_for_rbac_block_and_rbac_action_table extends Migration
{
    public const TABLE = '{{%rbac_block_rbac_action}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'rbac_block_id' => $this->integer(),
            'rbac_action_id' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'PRIMARY KEY(rbac_block_id, rbac_action_id)',
        ]);

        $this->createIndex('idx-rbac_block_rbac_action-rbac_block_id', self::TABLE, 'rbac_block_id');
        $this->addForeignKey('fk-rbac_block_rbac_action-rbac_block_id', self::TABLE, 'rbac_block_id', '{{%rbac_block}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-rbac_block_rbac_action-rbac_action_id', self::TABLE, 'rbac_action_id');
        $this->addForeignKey('fk-rbac_block_rbac_action-rbac_action_id', self::TABLE, 'rbac_action_id', '{{%rbac_action}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
