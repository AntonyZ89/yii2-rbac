<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_condition}}`.
 */
class m200810_012514_create_rbac_condition_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rbac_condition}}', [
            'id' => $this->primaryKey(),
            'rbac_condition_id' => $this->integer(),

            'logical_operator' => $this->tinyInteger(),
            'param' => $this->string()->notNull(),
            'operator' => $this->tinyInteger()->notNull(),
            'value' => $this->string(),
            'value_type' => $this->tinyInteger()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-rbac_condition-rbac_condition_id', '{{%rbac_condition}}', 'rbac_condition_id', true);
        $this->addForeignKey('fk-rbac_condition-rbac_condition_id', '{{%rbac_condition}}', 'rbac_condition_id', '{{%rbac_condition}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rbac_condition}}');
    }
}
