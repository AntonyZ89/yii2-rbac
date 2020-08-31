<?php

namespace antonyz89\rbac\controllers\base;

use Yii;
use yii\web\Controller as ControllerBase;
use yii\web\Response;

/**
 * Class Controller
 * @package antonyz89\rbac\controllers\base
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
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

    /**
     * {@inheritDoc}
     */
    public function render($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        }

        return parent::render($view, $params);
    }
}
