<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_controller}}`.
 */
class m200612_002951_create_rbac_controller_table extends Migration
{
    public const TABLE = '{{%rbac_controller}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull(),
            'application' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull()
        ]);

        $this->createIndex('idx-rbac_controller-name-application', self::TABLE, ['name', 'application'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
