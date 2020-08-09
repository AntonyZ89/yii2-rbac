<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacProfile;
use antonyz89\rbac\models\search\RbacProfileSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacProfileController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacProfileController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RbacProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new RbacProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'controllers' => $model->rbacProfileRbacControllers
        ]);
    }

    /**
     * @param integer $id
     * @return RbacProfile
     * @throws NotFoundHttpException
     */
    public static function findModel($id)
    {
        if (($model = RbacProfile::find($id)->with('rbacProfileRbacControllers')->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
