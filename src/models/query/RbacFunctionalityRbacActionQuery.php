<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacFunctionalityRbacAction;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacFunctionalityRbacAction]].
 *
 * @see RbacFunctionalityRbacAction
 */
class RbacFunctionalityRbacActionQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacFunctionalityRbacAction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacFunctionalityRbacAction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $rbac_functionality_id
     * @param string $operator
     * @return RbacFunctionalityRbacActionQuery
     */
    public function whereRbacFunctionality($rbac_functionality_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_functionality_id', RbacFunctionalityRbacAction::tableName()), $rbac_functionality_id
        ]);
    }

    /**
     * @param integer $rbac_action_id
     * @param string $operator
     * @return RbacFunctionalityRbacActionQuery
     */
    public function whereRbacAction($rbac_action_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_action_id', RbacFunctionalityRbacAction::tableName()), $rbac_action_id
        ]);
    }
}
