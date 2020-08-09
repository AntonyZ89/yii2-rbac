<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacBlock;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacBlock]].
 *
 * @see RbacBlock
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacBlockQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacBlock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacBlock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return RbacBlockQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', RbacBlock::tableName()), $id
        ]);
    }

    /**
     * @param integer $rbac_profile_id
     * @param string $operator
     * @return RbacBlockQuery
     */
    public function whereRbacProfile($rbac_profile_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_profile_id', RbacBlock::tableName()), $rbac_profile_id
        ]);
    }

    /**
     * @param integer $rbac_controller_id
     * @param string $operator
     * @return RbacBlockQuery
     */
    public function whereRbacController($rbac_controller_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rbac_controller_id', RbacBlock::tableName()), $rbac_controller_id
        ]);
    }

    /**
     * @param string $rule
     * @param string $operator
     * @return RbacBlockQuery
     */
    public function whereRule($rule, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rule', RbacBlock::tableName()), $rule
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return RbacBlockQuery
     */
    public function whereName($name, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', RbacBlock::tableName()), $name
        ]);
    }

    /**
     * @param string $description
     * @param string $operator
     * @return RbacBlockQuery
     */
    public function whereDescription($description, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.description', RbacBlock::tableName()), $description
        ]);
    }
}
