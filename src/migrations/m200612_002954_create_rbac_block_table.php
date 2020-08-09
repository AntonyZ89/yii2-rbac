<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_block}}`.
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class m200612_002954_create_rbac_block_table extends Migration
{
    public const TABLE = '{{%rbac_block}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'rbac_profile_id' => $this->integer()->notNull(),
            'rbac_controller_id' => $this->integer()->notNull(),

            'rule' => $this->string()->notNull(),
            'name' => $this->string(),
            'description' => $this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-rbac_block-rbac_profile_id-rbac_controller_id', '{{%rbac_block}}', ['rbac_profile_id', 'rbac_controller_id']);
        $this->addForeignKey('fk-rbac_block-rbac_profile_id-rbac_controller_id', '{{%rbac_block}}', ['rbac_profile_id', 'rbac_controller_id'], '{{%rbac_profile_rbac_controller}}', ['rbac_profile_id', 'rbac_controller_id'], 'CASCADE', 'CASCADE');

        $this->createIndex('idx-rbac_block-rbac_profile_id-rbac_controller_id-rule', self::TABLE, ['rbac_profile_id', 'rbac_controller_id', 'rule'], true);
        $this->createIndex('idx-rbac_block-rbac_profile_id-rbac_controller_id-name', self::TABLE, ['rbac_profile_id', 'rbac_controller_id', 'name'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
