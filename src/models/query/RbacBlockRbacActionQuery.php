<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacBlockRbacAction;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacBlockRbacAction]].
 *
 * @see RbacBlockRbacAction
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacBlockRbacActionQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacBlockRbacAction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacBlockRbacAction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $rbac_block_id
     * @param string $operator
     * @return RbacBlockRbacActionQuery
     */
    public function whereRbacBlock($rbac_block_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_block_id', RbacBlockRbacAction::tableName()), $rbac_block_id
        ]);
    }

    /**
     * @param integer $rbac_action_id
     * @param string $operator
     * @return RbacBlockRbacActionQuery
     */
    public function whereRbacAction($rbac_action_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_action_id', RbacBlockRbacAction::tableName()), $rbac_action_id
        ]);
    }
}
