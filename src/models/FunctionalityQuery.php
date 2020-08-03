<?php

namespace common\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Functionality]].
 *
 * @see Functionality
 */
class FunctionalityQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Functionality[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Functionality|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $id
     * @param string $operator
     * @return FunctionalityQuery
     */
    public function whereId($id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.id', Functionality::tableName()), $id
        ]);
    }

    /**
     * @param integer $functionality_category_id
     * @param string $operator
     * @return FunctionalityQuery
     */
    public function whereFunctionalityCategory($functionality_category_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.functionality_category_id', Functionality::tableName()), $functionality_category_id
        ]);
    }

    /**
     * @param string|string[] $rule
     * @param string $operator
     * @return FunctionalityQuery
     */
    public function whereRule($rule, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.rule', Functionality::tableName()), $rule
        ]);
    }

    /**
     * @param string $name
     * @param string $operator
     * @return FunctionalityQuery
     */
    public function whereName($name, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.name', Functionality::tableName()), $name
        ]);
    }

    /**
     * @param string $description
     * @param string $operator
     * @return FunctionalityQuery
     */
    public function whereDescription($description, $operator = 'LIKE')
    {
        return $this->andWhere([
            $operator, sprintf('%s.description', Functionality::tableName()), $description
        ]);
    }

    /**
     * @param integer $deleted_at
     * @param string $operator
     * @return FunctionalityQuery
     */
    public function whereDeletedAt($deleted_at, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.deleted_at', Functionality::tableName()), $deleted_at
        ]);
    }
}
