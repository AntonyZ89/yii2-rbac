<?php


namespace common\components;


/**
 * Trait Have
 * @package common\components
 * @deprecated 
 */
trait Have
{
    /**
     * same as `IdentityInterface::can`
     * but search rules on functionality table
     *
     * @param $rule
     * @return bool
     */
    public function have($rule)
    {
        return $this->profile->getFunctionalities()->whereRule($rule)->exists();
    }

}
