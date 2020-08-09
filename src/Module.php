<?php

namespace antonyz89\rbac;

use antonyz89\rbac\models\RbacAction;
use antonyz89\rbac\models\RbacController;
use TRegx\CleanRegex\Pattern;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\base\Module as ModuleBase;
use yii\helpers\Inflector;
use yii\web\ForbiddenHttpException;

class Module extends ModuleBase implements BootstrapInterface
{
    public $allowedIPs = ['127.0.0.1', '::1'];

    /** @var RbacController[] */
    public $controllers = [];

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id, 'route' => "$this->id/rbac-profile/index"],
//            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<id:\w+>', 'route' => "$this->id/default/view"],
//            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller:[\w\-]+>/<id:\d+>', 'route' => "$this->id/<controller>/<action>"],
//            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>', 'route' => "$this->id/<controller>/<action>"],
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller>/<action>', 'route' => "$this->id/<controller>/<action>"],
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller>/<action:[\w\-]+>/<id:\d+>', 'route' => "$this->id/<controller>/<action>"],
        ], false);
    }


    /**
     * {@inheritdoc}
     * @throws ForbiddenHttpException|InvalidConfigException
     */
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app instanceof yii\web\Application && !$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        $this->loadControllers();

        return true;
    }

    /**
     * @return boolean whether the module can be accessed by the current user
     */
    protected function checkAccess(): bool
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

    /**
     * Load controllers and actions of current module
     * @throws InvalidConfigException
     */
    public function loadControllers(): void
    {
        $controllers_id = array_map(static function ($value) {
            if (Pattern::of('^\w+Controller\.php$')->test($value)) {
                return Inflector::camel2id(str_replace('Controller.php', '', $value));
            }
            return null;
        }, scandir(Yii::$app->controllerPath));

        $controllers_id = array_filter($controllers_id, static function ($value) {
            return $value;
        });

        foreach ($controllers_id as $controller_id) {
            $controller = Yii::$app->createControllerByID($controller_id);
            $actions = array_keys($controller->actions());
            $function_action = array_map(static function ($value) {
                if ($value !== 'actions' && str_starts_with($value, 'action')) {
                    return Inflector::camel2id(str_replace('action', '', $value));
                }

                return null;
            }, get_class_methods($controller));

            $function_action = array_filter($function_action, static function ($value) {
                return $value;
            });

            $actions = array_merge($actions, $function_action);

            $this->controllers[$controller_id] = $actions;
        }

        $this->insertControllers();
    }

    public function insertControllers(): void
    {
        $application = Yii::$app->id;

        $db_controllers = array_map(static function ($value) {
            return $value->name;
        }, RbacController::find()->all());

        $not_inserted_ids = array_diff(array_keys($this->controllers), $db_controllers);

        foreach ($this->controllers as $controller_id => $actions) {
            if (in_array($controller_id, $not_inserted_ids, true)) {
                $controller = new RbacController();
                $controller->application = $application;
                $controller->name = $controller_id;
                $controller->save();
            }

            $this->insertActions($controller_id, $application, $actions);
        }

        $this->instanceControllers();
    }

    public function insertActions($controller_id, $application, $actions_id): void
    {
        $controller = RbacController::find()
            ->with('rbacActions')
            ->whereName($controller_id)
            ->whereApplication($application)
            ->one();

        $rbacActions = array_map(static function ($value) {
            return $value->name;
        }, $controller->rbacActions);

        $not_inserted_actions = array_diff($actions_id, $rbacActions);

        foreach ($actions_id as $action_id) {
            if (in_array($action_id, $not_inserted_actions, true)) {
                $rbacAction = new RbacAction();
                $rbacAction->rbac_controller_id = $controller->id;
                $rbacAction->name = $action_id;
                $rbacAction->save();

            }
        }
    }

    public function instanceControllers()
    {
        $_controllers = [];

        foreach ($this->controllers as $id => $actions) {
            $_controllers[] = RbacController::find()
                ->with('rbacActions', 'rbacBlocks')
                ->whereName($id)
                ->one();
        }

        $this->controllers = $_controllers;
    }
}
