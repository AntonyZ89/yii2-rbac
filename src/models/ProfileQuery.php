<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Profile]].
 *
 * @see Profile
 */
class ProfileQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Profile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Profile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return ProfileQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', Profile::tableName()), $id
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return ProfileQuery
     */
    public function whereName($name, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', Profile::tableName()), $name
        ]);
    }

    /**
     * @param string $description
     * @param string $operator
     * @return ProfileQuery
     */
    public function whereDescription($description, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.description', Profile::tableName()), $description
        ]);
    }

    /**
     * @param $q
     * @return ProfileQuery
     */
    public function search($q)
    {
        return $this->andFilterWhere([
            'OR',
            ['LIKE', sprintf('%s.name', Profile::tableName()), $q]
        ]);
    }

    /**
     * @param bool $bool
     * @return ProfileQuery
     */
    public function whereNotDeleted($bool = true)
    {
        return $this->andWhere([
            $bool ? 'IS' : 'IS NOT', sprintf('%s.deleted_at', Profile::tableName()), null
        ]);
    }

    /**
     * @param string $order
     * @return ProfileQuery
     */
    public function order($order = 'id DESC')
    {
        return $this->orderBy($order);
    }
}
