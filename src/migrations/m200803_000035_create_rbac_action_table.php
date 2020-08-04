<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_action}}`.
 */
class m200803_000035_create_rbac_action_table extends Migration
{
    public const TABLE = '{{%rbac_action}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'rbac_controller_id' => $this->integer()->notNull(),
            
            'name' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull()
        ]);

        $this->createIndex('idx-rbac_action-rbac_functionality_id', self::TABLE, 'rbac_controller_id');
        $this->addForeignKey('fk-rbac_action-rbac_functionality_id', self::TABLE, 'rbac_controller_id', '{{%rbac_controller}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
