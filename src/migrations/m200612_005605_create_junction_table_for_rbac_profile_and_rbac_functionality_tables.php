<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_profile_rbac_functionality}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rbac_profile}}`
 * - `{{%rbac_functionality}}`
 */
class m200612_005605_create_junction_table_for_rbac_profile_and_rbac_functionality_tables extends Migration
{
    public const TABLE = '{{%rbac_profile_rbac_functionality}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'rbac_profile_id' => $this->integer()->notNull(),
            'rbac_functionality_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('pk-profile_functionality-profile_id-functionality_id', self::TABLE, ['rbac_profile_id', 'rbac_functionality_id']);

        $this->createIndex('idx-rbac_profile_rbac_functionality-rbac_profile_id', self::TABLE, 'rbac_profile_id');
        $this->addForeignKey('fk-rbac_profile_rbac_functionality-rbac_profile_id', self::TABLE, 'rbac_profile_id', '{{%rbac_profile}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-rbac_profile_rbac_functionality-rbac_functionality_id', self::TABLE, 'rbac_functionality_id');
        $this->addForeignKey('fk-rbac_profile_rbac_functionality-rbac_functionality_id', self::TABLE, 'rbac_functionality_id', '{{%rbac_functionality}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
