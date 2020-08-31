<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacCondition;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacCondition]].
 *
 * @see RbacCondition
 */
class RbacConditionQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacCondition[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacCondition|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return RbacConditionQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', RbacCondition::tableName()), $id
        ]);
    }

    /**
     * @param integer $rbac_condition_id
     * @param string $operator
     * @return RbacConditionQuery
     */
    public function whereRbacConditionParent($rbac_condition_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_condition_id', RbacCondition::tableName()), $rbac_condition_id
        ]);
    }

    /**
     * @param string $param
     * @param string $operator
     * @return RbacConditionQuery
     */
    public function whereParam($param, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.param', RbacCondition::tableName()), $param
        ]);
    }

    /**
     * @param integer $operator
     * @param string $_operator
     * @return RbacConditionQuery
     */
    public function whereOperator($operator, $_operator = '=')
    {
        return $this->andWhere([
            $_operator, sprintf('%s.operator', RbacCondition::tableName()), $operator
        ]);
    }

    /**
     * @param string $value
     * @param string $operator
     * @return RbacConditionQuery
     */
    public function whereValue($value, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.value', RbacCondition::tableName()), $value
        ]);
    }

    /**
     * @param integer $logical_operator
     * @param string $operator
     * @return RbacConditionQuery
     */
    public function whereLogicalOperator($logical_operator, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.logical_operator', RbacCondition::tableName()), $logical_operator
        ]);
    }

}
