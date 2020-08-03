<?php
namespace antonyz89\rbac\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DefaultController extends Controller
{
    /** @var \antonyz89\rbac\Module */
    public $module;

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_HTML;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->layout = 'main';

        return $this->render('index');
    }
}
