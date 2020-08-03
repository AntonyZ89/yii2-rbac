<?php

namespace antonyz89\rbac\seeder;

use antonyz89\seeder\TableSeeder;
use common\models\Profile;

/**
 * Handles the creation of seeder `{{%profile}}`.
 */
class ProfileTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    function run()
    {
        $this->batchInsert(Profile::tableName(),
            ['name', 'description', 'deleted_at'],
            [
                ['Admin', 'Admin', null],
                ['Central', 'Central', null]
            ]
        );
    }
}
