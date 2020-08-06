<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\models\RbacAction;
use antonyz89\rbac\models\RbacController;
use antonyz89\rbac\models\RbacFunctionality;
use antonyz89\rbac\models\RbacFunctionalityRbacAction;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /** RBAC FUNCTIONALITY */

    /**
     * @param integer $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionCreateFunctionality($id)
    {
        $controller = self::findControllerModel($id);
        $model = new RbacFunctionality();
        $model->controller_id = $controller->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('/functionality/create', [
            'model' => $model
        ]);
    }

    /** RBAC ACTION */

    /**
     * @param integer $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionCreateAction($id)
    {
        $functionality = self::findFunctionalityModel($id);
        $model = new RbacFunctionalityRbacAction();
        $model->rbac_functionality_id = $functionality->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('/action/create', [
            'model' => $model
        ]);
    }


    /** SEARCHES */

    /**
     * @param integer $functionality_id
     * @param string|null $q
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionSearchAction($functionality_id, $q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rbacFunctionality = self::findFunctionalityModel($functionality_id);

        $actions_id = RbacFunctionalityRbacAction::find()
            ->select('rbac_action_id')
            ->whereRbacFunctionality($functionality_id);

        $query = RbacAction::find()
            ->whereRbacController($rbacFunctionality->controller_id)
            ->whereId($actions_id, 'NOT IN');

        if ($q) {
            $query->whereName($q);
        }

        $results = ArrayHelper::getColumn($query->limit(10)->all(), static function (RbacAction $model) {
            return [
                'id' => $model->id,
                'text' => (string)$model
            ];
        });

        return ['results' => $results];
    }

    /**
     * @param integer $id
     * @return RbacController
     * @throws NotFoundHttpException
     */
    public static function findControllerModel($id)
    {
        if (($model = RbacController::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param integer $id
     * @return RbacFunctionality
     * @throws NotFoundHttpException
     */
    public static function findFunctionalityModel($id)
    {
        if (($model = RbacFunctionality::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
