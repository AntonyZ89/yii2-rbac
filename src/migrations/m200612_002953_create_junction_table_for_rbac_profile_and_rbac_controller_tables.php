<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_profile_rbac_controller}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rbac_profile}}`
 * - `{{%rbac_controller}}`
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class m200612_002953_create_junction_table_for_rbac_profile_and_rbac_controller_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rbac_profile_rbac_controller}}', [
            'rbac_profile_id' => $this->integer(),
            'rbac_controller_id' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'PRIMARY KEY(rbac_profile_id, rbac_controller_id)',
        ]);

        // creates index for column `rbac_profile_id`
        $this->createIndex(
            '{{%idx-rbac_profile_rbac_controller-rbac_profile_id}}',
            '{{%rbac_profile_rbac_controller}}',
            'rbac_profile_id'
        );

        // add foreign key for table `{{%rbac_profile}}`
        $this->addForeignKey(
            '{{%fk-rbac_profile_rbac_controller-rbac_profile_id}}',
            '{{%rbac_profile_rbac_controller}}',
            'rbac_profile_id',
            '{{%rbac_profile}}',
            'id',
            'CASCADE'
        );

        // creates index for column `rbac_controller_id`
        $this->createIndex(
            '{{%idx-rbac_profile_rbac_controller-rbac_controller_id}}',
            '{{%rbac_profile_rbac_controller}}',
            'rbac_controller_id'
        );

        // add foreign key for table `{{%rbac_controller}}`
        $this->addForeignKey(
            '{{%fk-rbac_profile_rbac_controller-rbac_controller_id}}',
            '{{%rbac_profile_rbac_controller}}',
            'rbac_controller_id',
            '{{%rbac_controller}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%rbac_profile}}`
        $this->dropForeignKey(
            '{{%fk-rbac_profile_rbac_controller-rbac_profile_id}}',
            '{{%rbac_profile_rbac_controller}}'
        );

        // drops index for column `rbac_profile_id`
        $this->dropIndex(
            '{{%idx-rbac_profile_rbac_controller-rbac_profile_id}}',
            '{{%rbac_profile_rbac_controller}}'
        );

        // drops foreign key for table `{{%rbac_controller}}`
        $this->dropForeignKey(
            '{{%fk-rbac_profile_rbac_controller-rbac_controller_id}}',
            '{{%rbac_profile_rbac_controller}}'
        );

        // drops index for column `rbac_controller_id`
        $this->dropIndex(
            '{{%idx-rbac_profile_rbac_controller-rbac_controller_id}}',
            '{{%rbac_profile_rbac_controller}}'
        );

        $this->dropTable('{{%rbac_profile_rbac_controller}}');
    }
}
