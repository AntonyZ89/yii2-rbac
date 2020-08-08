<?php

namespace antonyz89\rbac\components;

use antonyz89\rbac\models\query\RbacActionQuery;
use antonyz89\rbac\models\query\RbacControllerQuery;
use antonyz89\rbac\models\query\RbacFunctionalityQuery;
use antonyz89\rbac\models\query\RbacProfileQuery;
use antonyz89\rbac\models\query\RbacProfileRbacControllerQuery;
use Yii;
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

        $_user = $user->identity;
        $can = true;

        foreach ($items as $item) {
//            if (is_array($item)) {
//                $can &= self::recursive($item, $_user);
//            } else {
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
            }

            $can &= self::have($_user, Yii::$app->controller->id, Yii::$app->controller->action->id);
//            }
        }

        return $can;
    }


    /**
     * @param $item array
     * @param $_user
     * @return bool|mixed
     * @deprecated
     */
    /*protected static function recursive($item, $_user)
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
    }*/

    /**
     * Search profile for current controller/action
     *
     * @param $user
     * @param string $controller_id
     * @param string|null $action_id
     * @return bool
     */
    public static function have($user, $controller_id, $action_id = null)
    {
        /** @var RbacProfileQuery $profile */
        $profile = $user->getRbacProfile()->joinWith([
            'rbacProfileRbacControllers' => static function (RbacProfileRbacControllerQuery $query) use ($action_id, $controller_id) {
                $query->joinWith([
                    'rbacController' => static function (RbacControllerQuery $query) use ($controller_id) {
                        $query->whereName($controller_id);
                    },
                ]);

                if ($action_id) {
                    $query->joinWith([
                        'rbacFunctionalities' => static function (RbacFunctionalityQuery $query) use ($action_id) {
                            $query->joinWith([
                                'rbacActions' => static function (RbacActionQuery $query) use ($action_id) {
                                    $query->whereName($action_id);
                                }
                            ]);
                        }
                    ]);
                }
            }
        ]);

        return $profile->exists();
    }

}
