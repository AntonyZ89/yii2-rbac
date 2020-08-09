<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacProfileRbacController;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacProfileRbacControllerController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacProfileRbacControllerController extends Controller
{
    /**
     * @param integer $rbac_profile_id
     * @return string|Response
     */
    public function actionCreate($rbac_profile_id)
    {
        $model = new RbacProfileRbacController();
        $model->rbac_profile_id = $rbac_profile_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $rbac_profile_id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $rbac_profile_id
     * @param integer $rbac_controller_id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($rbac_profile_id, $rbac_controller_id)
    {
        $model = self::findModel($rbac_profile_id, $rbac_controller_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $model->rbac_profile_id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $rbac_profile_id
     * @param integer $rbac_controller_id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($rbac_profile_id, $rbac_controller_id)
    {
        self::findModel($rbac_profile_id, $rbac_controller_id)->delete();

        return $this->redirect(['rbac-profile/update', 'id' => $rbac_profile_id]);
    }

    /**
     * @param integer $rbac_profile_id
     * @param integer $rbac_controller_id
     * @return RbacProfileRbacController
     * @throws NotFoundHttpException
     */
    public static function findModel($rbac_profile_id, $rbac_controller_id)
    {
        $model = RbacProfileRbacController::find()
            ->whereRbacProfile($rbac_profile_id)
            ->whereRbacController($rbac_controller_id)
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
