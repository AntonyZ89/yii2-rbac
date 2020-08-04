<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_functionality}}`.
 */
class m200612_002953_create_rbac_functionality_table extends Migration
{
    public const TABLE = '{{%rbac_functionality}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'controller_id' => $this->integer()->notNull(),

            'rule' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-rbac_functionality-controller_id', self::TABLE, 'controller_id');
        $this->addForeignKey('fk-rbac_functionality-controller_id', self::TABLE, 'controller_id', '{{%rbac_controller}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-rbac_functionality-controller_id-rule-name', self::TABLE, ['controller_id', 'rule', 'name'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
