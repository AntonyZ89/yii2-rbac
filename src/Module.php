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

    /** @var string[][] */
    protected $controllers = [];

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app): void
    {
        $app->urlManager->addRules([
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id, 'route' => "$this->id/rbac-profile/index"],
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller>/<action>', 'route' => "$this->id/<controller>/<action>"],
            ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<controller>/<action:[\w\-]+>/<id:\d+>', 'route' => "$this->id/<controller>/<action>"],
        ], false);
    }


    /**
     * {@inheritdoc}
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app instanceof yii\web\Application && !$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        if ($action->controller->id === 'rbac-profile' && $action->id === 'update') {
            foreach (Yii::$aliases as $alias => $path) {
                $controller_path = Yii::getAlias("$alias/controllers", false);
                if ($controller_path && !in_array($alias, ['@console', '@app']) && file_exists($controller_path)) {
                    $this->loadControllers(str_replace('@', '', $alias));
                }
            }
        }

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
     * @param string $application
     */
    public function loadControllers(string $application): void
    {
        $controllers_id = array_map(static function ($value) {
            if (Pattern::of('^\w+Controller\.php$')->test($value)) {
                return Inflector::camel2id(str_replace('Controller.php', '', $value));
            }
            return null;
        }, scandir(Yii::getAlias("@$application/controllers")));

        $controllers_id = array_filter($controllers_id, static function ($value) {
            return $value;
        });

        foreach ($controllers_id as $controller_id) {
            $className = "$application\\controllers\\" . Inflector::id2camel($controller_id) . 'Controller';
            $controller = new $className($controller_id, $this);

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

        $this->insertControllers($application);
    }

    /**
     * @param string $application
     */
    public function insertControllers(string $application): void
    {
        $db_controllers = array_map(static function ($value) {
            return $value->name;
        }, RbacController::find()->whereApplication($application)->all());

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

        $this->controllers = [];
    }

    /**
     * @param string $controller_id
     * @param string $application
     * @param string[] $actions_id
     */
    public function insertActions(string $controller_id, string $application, array $actions_id): void
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

        foreach ($not_inserted_actions as $action_id) {
            $rbacAction = new RbacAction();
            $rbacAction->rbac_controller_id = $controller->id;
            $rbacAction->name = $action_id;
            $rbacAction->save();
        }
    }
}
