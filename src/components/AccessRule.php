<?php

namespace antonyz89\rbac\components;

use yii\base\InvalidConfigException;
use yii\filters\AccessRule as AccessRuleBase;
use yii\web\User;

class AccessRule extends AccessRuleBase
{
    /**
     * @param User $user the user object
     * @return bool whether the rule applies to the role
     * @throws InvalidConfigException if User component is detached
     */
    public function matchRole($user)
    {
        $items = empty($this->roles) ? [] : $this->roles;

        if (!empty($this->permissions)) {
            $items = array_merge($items, $this->permissions);
        }

        if (empty($items)) {
            return true;
        }

        if ($user === false) {
            throw new InvalidConfigException('The user application component must be available to specify roles in AccessRule.');
        }

        /** @var \common\models\user\User $_user */
        $_user = $user->identity;
        $can = true;

        foreach ($items as $item) {
            if (is_array($item)) {
                $can &= self::recursive($item, $_user);
            } else {
                switch ($item) {
                    case '?':
                        if (!$user->isGuest) {
                            return false;
                        }
                        break;
                    case '@':
                        if ($user->isGuest) {
                            return false;
                        }
                        break;
                    default:
                        $can &= $_user->have($item);
                }
            }
        }

        return $can;
    }

    /**
     * @param $item array
     * @param $_user \common\models\user\User
     * @return bool|mixed
     */
    protected static function recursive($item, $_user)
    {
        $_can = true;
        $condition = array_shift($item); // AND, OR
        foreach ($item as $value) {
            if (is_array($value)) {
                if ($condition === 'AND' && !($_can &= self::recursive($value, $_user))) {
                    break;
                }
                if ($condition === 'OR' && ($_can = self::recursive($value, $_user))) {
                    break;
                }
            } else {
                if ($condition === 'AND' && !($_can &= $_user->have($value))) {
                    break;
                }
                if ($condition === 'OR' && ($_can = $_user->have($value))) {
                    break;
                }
            }
        }

        return $_can;
    }

}
