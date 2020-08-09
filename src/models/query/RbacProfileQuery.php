<?php

namespace antonyz89\rbac\models\query;

use antonyz89\rbac\models\RbacProfile;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RbacProfile]].
 *
 * @see RbacProfile
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacProfileQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return RbacProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RbacProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return RbacProfileQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', RbacProfile::tableName()), $id
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return RbacProfileQuery
     */
    public function whereName($name, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', RbacProfile::tableName()), $name
        ]);
    }

    /**
     * @param string $description
     * @param string $operator
     * @return RbacProfileQuery
     */
    public function whereDescription($description, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.description', RbacProfile::tableName()), $description
        ]);
    }
}
