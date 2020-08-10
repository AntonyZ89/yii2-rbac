<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacBlockRbacCondition;
use antonyz89\rbac\models\RbacCondition;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacBlockRbacConditionController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.2.1
 */
class RbacBlockRbacConditionController extends Controller
{
    /**
     * @param integer $rbac_block_id
     * @param integer $rbac_condition_id
     * @return string|Response
     */
    public function actionCreate($rbac_block_id, $rbac_condition_id)
    {
        $model = new RbacBlockRbacCondition();
        $model->rbac_block_id = $rbac_block_id;
        $model->rbac_condition_id = $rbac_condition_id;
        $model->save();

        return $this->redirect(['rbac-block/update', 'id' => $rbac_block_id]);
    }

    /**
     * @param integer $rbac_block_id
     * @param integer $rbac_condition_id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($rbac_block_id, $rbac_condition_id)
    {
        $model = self::findModel($rbac_block_id, $rbac_condition_id);
        $model->delete();
        return $this->redirect(['rbac-block/update', 'id' => $model->rbac_block_id]);
    }

    /**
     * @param integer $rbac_block_id
     * @param integer $rbac_condition_id
     * @return RbacBlockRbacCondition
     * @throws NotFoundHttpException
     */
    public static function findModel($rbac_block_id, $rbac_condition_id)
    {
        $model = RbacBlockRbacCondition::find()
            ->whereRbacBlock($rbac_block_id)
            ->whereRbacCondition($rbac_condition_id)
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
