<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacController;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacController]].
 *
 * @see RbacController
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacControllerQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return RbacController[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacController|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return RbacControllerQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', RbacController::tableName()), $id
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return RbacControllerQuery
     */
    public function whereName($name, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', RbacController::tableName()), $name
        ]);
    }

    /**
     * @param string $application
     * @param string $operator
     * @return RbacControllerQuery
     */
    public function whereApplication($application, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.application', RbacController::tableName()), $application
        ]);
    }

    /**
     * @param string|null $q
     * @return RbacControllerQuery
     */
    public function search($q = null)
    {
        return $this->andFilterWhere([
            'OR',
            ['LIKE', sprintf('%s.name', RbacController::tableName()), $q],
            ['LIKE', sprintf('%s.application', RbacController::tableName()), $q]
        ]);
    }
}
