<?php

namespace antonyz89\rbac\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile_functionality}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%profile}}`
 * - `{{%functionality}}`
 */
class m200612_005605_create_junction_table_for_profile_and_functionality_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile_functionality}}', [
            'profile_id' => $this->integer()->notNull(),
            'functionality_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('pk-profile_functionality-profile_id-functionality_id', '{{%profile_functionality}}', ['profile_id', 'functionality_id']);

        $this->createIndex('idx-profile_functionality-profile_id', '{{%profile_functionality}}', 'profile_id');
        $this->addForeignKey('fk-profile_functionality-profile_id', '{{%profile_functionality}}', 'profile_id', '{{%profile}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-profile_functionality-functionality_id', '{{%profile_functionality}}', 'functionality_id');
        $this->addForeignKey('fk-profile_functionality-functionality_id', '{{%profile_functionality}}', 'functionality_id', '{{%functionality}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile_functionality}}');
    }
}
