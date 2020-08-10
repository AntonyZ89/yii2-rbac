<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacBlockRbacAction;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacBlockRbacActionController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacBlockRbacActionController extends Controller
{
    /**
     * @param integer $rbac_block_id
     * @return string|Response
     */
    public function actionCreate($rbac_block_id)
    {
        $model = new RbacBlockRbacAction();
        $model->rbac_block_id = $rbac_block_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $model->rbacBlock->rbac_profile_id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $rbac_block_id
     * @param integer $rbac_action_id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($rbac_block_id, $rbac_action_id)
    {
        $model = self::findModel($rbac_block_id, $rbac_action_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-profile/update', 'id' => $model->rbacBlock->rbac_profile_id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $rbac_block_id
     * @param integer $rbac_action_id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($rbac_block_id, $rbac_action_id)
    {
        $model = self::findModel($rbac_block_id, $rbac_action_id);
        $model->delete();
        return $this->redirect(['rbac-profile/update', 'id' => $model->rbacBlock->rbac_profile_id]);
    }

    /**
     * @param integer $rbac_block_id
     * @param integer $rbac_action_id
     * @return RbacBlockRbacAction
     * @throws NotFoundHttpException
     */
    public static function findModel($rbac_block_id, $rbac_action_id)
    {
        $model = RbacBlockRbacAction::find()
            ->whereRbacBlock($rbac_block_id)
            ->whereRbacAction($rbac_action_id)
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
