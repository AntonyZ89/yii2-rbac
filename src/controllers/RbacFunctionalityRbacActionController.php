<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacFunctionalityRbacAction;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacFunctionalityRbacActionController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacFunctionalityRbacActionController extends Controller
{
    /**
     * @param integer $functionality_id
     * @return string|Response
     */
    public function actionCreate($functionality_id)
    {
        $model = new RbacFunctionalityRbacAction();
        $model->rbac_functionality_id = $functionality_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $model->rbacFunctionality->rbac_profile_id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $rbac_functionality_id
     * @param integer $rbac_action_id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($rbac_functionality_id, $rbac_action_id)
    {
        $model = self::findModel($rbac_functionality_id, $rbac_action_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $model->rbacFunctionality->rbac_profile_id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $rbac_functionality_id
     * @param integer $rbac_action_id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($rbac_functionality_id, $rbac_action_id)
    {
        $model = self::findModel($rbac_functionality_id, $rbac_action_id);
        $model->delete();
        return $this->redirect(['rbac-profile/update', 'id' => $model->rbacFunctionality->rbac_profile_id]);
    }

    /**
     * @param integer $rbac_functionality_id
     * @param integer $rbac_action_id
     * @return RbacFunctionalityRbacAction
     * @throws NotFoundHttpException
     */
    public static function findModel($rbac_functionality_id, $rbac_action_id)
    {
        $model = RbacFunctionalityRbacAction::find()
            ->whereRbacFunctionality($rbac_functionality_id)
            ->whereRbacAction($rbac_action_id)
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
