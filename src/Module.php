<?php

namespace antonyz89\rbac;

use Yii;
use yii\base\Module as ModuleBase;
use yii\web\Application;
use yii\web\ForbiddenHttpException;

class Module extends ModuleBase
{
    public $allowedIPs = ['127.0.0.1', '::1'];

    /**
     * {@inheritdoc}
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app instanceof Application && !$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        return true;
    }

    /**
     * @return int whether the module can be accessed by the current user
     */
    protected function checkAccess()
    {
        $ip = Yii::$app->getRequest()->getUserIP();

        foreach ($this->allowedIPs as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                return true;
            }
        }

        Yii::warning("Access to RBAC Manager is denied due to IP address restriction. The requested IP is $ip", __METHOD__);

        return false;
    }

}
