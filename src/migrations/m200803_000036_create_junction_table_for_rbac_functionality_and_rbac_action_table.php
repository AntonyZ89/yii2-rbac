<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_functionality_rbac_action}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rbac_functionality}}`
 * - `{{%rbac_action}}`
 */
class m200803_000036_create_junction_table_for_rbac_functionality_and_rbac_action_table extends Migration
{
    public const TABLE = '{{%rbac_functionality_rbac_action}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'rbac_functionality_id' => $this->integer()->notNull(),
            'rbac_action_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('pk-functionality_action-functionality_id-action_id', self::TABLE, ['rbac_functionality_id', 'rbac_action_id']);

        $this->createIndex('idx-rbac_functionality_rbac_action-rbac_functionality_id', self::TABLE, 'rbac_functionality_id');
        $this->addForeignKey('fk-rbac_functionality_rbac_action-rbac_functionality_id', self::TABLE, 'rbac_functionality_id', '{{%rbac_functionality}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-rbac_functionality_rbac_action-rbac_action_id', self::TABLE, 'rbac_action_id');
        $this->addForeignKey('fk-rbac_functionality_rbac_action-rbac_action_id', self::TABLE, 'rbac_action_id', '{{%rbac_action}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
