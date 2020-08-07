<?php

namespace antonyz89\rbac\controllers\base;

use antonyz89\rbac\models\RbacAction;
use antonyz89\rbac\models\RbacController;
use antonyz89\rbac\models\RbacFunctionality;
use antonyz89\rbac\models\RbacFunctionalityRbacAction;
use antonyz89\rbac\models\search\RbacProfileSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller as ControllerBase;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Controller extends ControllerBase
{
    /** @var \antonyz89\rbac\Module */
    public $module;

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $this->layout = 'main';
        Yii::$app->params['bsVersion'] = '4.x';

        Yii::$app->response->format = Response::FORMAT_HTML;
        return parent::beforeAction($action);
    }

    public function render($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        }

        return parent::render($view, $params);
    }
}
