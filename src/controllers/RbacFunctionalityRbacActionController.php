<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacAction;
use antonyz89\rbac\models\RbacController;
use antonyz89\rbac\models\RbacFunctionality;
use antonyz89\rbac\models\RbacFunctionalityRbacAction;
use antonyz89\rbac\models\RbacProfile;
use antonyz89\rbac\models\RbacProfileRbacController;
use antonyz89\rbac\models\search\RbacProfileSearch;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class RbacFunctionalityRbacActionController extends Controller
{
    /**
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
     * @param $id
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
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($rbac_functionality_id, $rbac_action_id)
    {
        $model = self::findModel($rbac_functionality_id, $rbac_action_id);
        $model->delete();
        return $this->redirect(['rbac-profile/update', 'id' => $model->rbacFunctionality->rbac_profile_id]);
    }

    /**
     * @param integer $id
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
