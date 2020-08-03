<?php

namespace antonyz89\rbac\seeder;

use antonyz89\seeder\TableSeeder;
use common\models\Account;
use common\models\Functionality;
use common\models\Profile;
use common\models\ProfileFunctionality;

/**
 * Handles the creation of seeder `{{%profile_functionality}}`.
 */
class ProfileFunctionalityTableSeeder extends TableSeeder
{

    /**
     * {@inheritdoc}
     */
    function run()
    {
        $accounts = Account::find()->all();

        foreach ($accounts as $account) {
            $profile_admin = Profile::find()->whereAccount($account->id)->whereName('Admin')->one();
            $profile_central = Profile::find()->whereAccount($account->id)->whereName('Central')->one();

            $functionalities = Functionality::find()->all();
            $functionalities_central = Functionality::find()
                ->whereRule([
                    Functionality::ORDER_MANAGE,
                    Functionality::DELIVERYMAN_MANAGE,
                    Functionality::DELIVERYMAN_VIEW
                ], 'IN')
                ->all();

            foreach ($functionalities as $i => $functionality) {
                $this->insert(ProfileFunctionality::tableName(), [
                    'profile_id' => $profile_admin->id,
                    'functionality_id' => $functionality->id,
                ]);
            }

            foreach ($functionalities_central as $functionality) {
                $this->insert(ProfileFunctionality::tableName(), [
                    'profile_id' => $profile_central->id,
                    'functionality_id' => $functionality->id
                ]);
            }
        }
    }
}
