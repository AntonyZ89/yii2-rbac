<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rbac_profile}}`.
 */
class m200612_002952_create_rbac_profile_table extends Migration
{
    public const TABLE = '{{%rbac_profile}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-profile-name', self::TABLE, 'name', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
