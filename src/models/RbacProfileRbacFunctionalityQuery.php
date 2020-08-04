<?php

namespace antonyz89\rbac\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacProfileRbacFunctionality]].
 *
 * @see RbacProfileRbacFunctionality
 */
class RbacProfileRbacFunctionalityQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacProfileRbacFunctionality[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacProfileRbacFunctionality|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $rbac_profile_id
     * @param string $operator
     * @return RbacProfileRbacFunctionalityQuery
     */
    public function whereRbacProfile($rbac_profile_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_profile_id', RbacProfileRbacFunctionality::tableName()), $rbac_profile_id
        ]);
    }

    /**
     * @param integer $rbac_functionality_id
     * @param string $operator
     * @return RbacProfileRbacFunctionalityQuery
     */
    public function whereRbacFunctionality($rbac_functionality_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_functionality_id', RbacProfileRbacFunctionality::tableName()), $rbac_functionality_id
        ]);
    }
}
