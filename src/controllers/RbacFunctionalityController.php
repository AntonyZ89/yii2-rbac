<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacFunctionality;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacFunctionalityController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacFunctionalityController extends Controller
{
    /**
     * @return string|Response
     */
    public function actionCreate($profile_id, $controller_id)
    {
        $model = new RbacFunctionality();
        $model->rbac_profile_id = $profile_id;
        $model->rbac_controller_id = $controller_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $profile_id]);
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
            return $this->redirect(['rbac-profile/update', 'id' => $model->rbac_profile_id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = self::findModel($id);
        $model->delete();
        return $this->redirect(['rbac-profile/update', 'id' => $model->rbac_profile_id]);
    }

    /**
     * @param integer $id
     * @return RbacFunctionality
     * @throws NotFoundHttpException
     */
    public static function findModel($id)
    {
        if (($model = RbacFunctionality::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
