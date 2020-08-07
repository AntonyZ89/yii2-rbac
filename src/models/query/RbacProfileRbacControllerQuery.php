<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacProfileRbacController;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacProfileRbacController]].
 *
 * @see RbacProfileRbacController
 */
class RbacProfileRbacControllerQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacProfileRbacController[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacProfileRbacController|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $rbac_profile_id
     * @param string $operator
     * @return RbacProfileRbacControllerQuery
     */
    public function whereRbacProfile($rbac_profile_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_profile_id', RbacProfileRbacController::tableName()), $rbac_profile_id
        ]);
    }

    /**
     * @param integer $rbac_controller_id
     * @param string $operator
     * @return RbacProfileRbacControllerQuery
     */
    public function whereRbacController($rbac_controller_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_controller_id', RbacProfileRbacController::tableName()), $rbac_controller_id
        ]);
    }
}
