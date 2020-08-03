<?php

namespace common\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ProfileFunctionality]].
 *
 * @see ProfileFunctionality
 */
class ProfileFunctionalityQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProfileFunctionality[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProfileFunctionality|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param integer $profile_id
     * @param string $operator
     * @return ProfileFunctionalityQuery
     */
    public function whereProfile($profile_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.profile_id', ProfileFunctionality::tableName()), $profile_id
        ]);
    }

    /**
     * @param integer $functionality_id
     * @param string $operator
     * @return ProfileFunctionalityQuery
     */
    public function whereFunctionality($functionality_id, $operator = '=')
    {
        return $this->andWhere([
            $operator, sprintf('%s.functionality_id', ProfileFunctionality::tableName()), $functionality_id
        ]);
    }
}
