<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacBlockRbacCondition;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacBlockRbacCondition]].
 *
 * @see RbacBlockRbacCondition
 */
class RbacBlockRbacConditionQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacBlockRbacCondition[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacBlockRbacCondition|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $rbac_block_id
     * @param string $operator
     * @return RbacBlockRbacConditionQuery
     */
    public function whereRbacBlock($rbac_block_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_block_id', RbacBlockRbacCondition::tableName()), $rbac_block_id
        ]);
    }

    /**
     * @param integer $rbac_condition_id
     * @param string $operator
     * @return RbacBlockRbacConditionQuery
     */
    public function whereRbacCondition($rbac_condition_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_condition_id', RbacBlockRbacCondition::tableName()), $rbac_condition_id
        ]);
    }

}
