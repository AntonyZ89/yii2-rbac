<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_block_rbac_condition}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rbac_block}}`
 * - `{{%rbac_condition}}`
 */
class m200810_012609_create_junction_table_for_rbac_block_and_rbac_condition_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rbac_block_rbac_condition}}', [
            'rbac_block_id' => $this->integer(),
            'rbac_condition_id' => $this->integer(),

            'created_at' => $this->integer(),

            'PRIMARY KEY(rbac_block_id, rbac_condition_id)',
        ]);

        // creates index for column `rbac_block_id`
        $this->createIndex(
            '{{%idx-rbac_block_rbac_condition-rbac_block_id}}',
            '{{%rbac_block_rbac_condition}}',
            'rbac_block_id'
        );

        // add foreign key for table `{{%rbac_block}}`
        $this->addForeignKey(
            '{{%fk-rbac_block_rbac_condition-rbac_block_id}}',
            '{{%rbac_block_rbac_condition}}',
            'rbac_block_id',
            '{{%rbac_block}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `rbac_condition_id`
        $this->createIndex(
            '{{%idx-rbac_block_rbac_condition-rbac_condition_id}}',
            '{{%rbac_block_rbac_condition}}',
            'rbac_condition_id',
            true
        );

        // add foreign key for table `{{%rbac_condition}}`
        $this->addForeignKey(
            '{{%fk-rbac_block_rbac_condition-rbac_condition_id}}',
            '{{%rbac_block_rbac_condition}}',
            'rbac_condition_id',
            '{{%rbac_condition}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%rbac_block}}`
        $this->dropForeignKey(
            '{{%fk-rbac_block_rbac_condition-rbac_block_id}}',
            '{{%rbac_block_rbac_condition}}'
        );

        // drops index for column `rbac_block_id`
        $this->dropIndex(
            '{{%idx-rbac_block_rbac_condition-rbac_block_id}}',
            '{{%rbac_block_rbac_condition}}'
        );

        // drops foreign key for table `{{%rbac_condition}}`
        $this->dropForeignKey(
            '{{%fk-rbac_block_rbac_condition-rbac_condition_id}}',
            '{{%rbac_block_rbac_condition}}'
        );

        // drops index for column `rbac_condition_id`
        $this->dropIndex(
            '{{%idx-rbac_block_rbac_condition-rbac_condition_id}}',
            '{{%rbac_block_rbac_condition}}'
        );

        $this->dropTable('{{%rbac_block_rbac_condition}}');
    }
}
