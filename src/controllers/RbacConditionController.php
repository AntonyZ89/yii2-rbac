<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacBlock;
use antonyz89\rbac\models\RbacBlockRbacCondition;
use antonyz89\rbac\models\RbacCondition;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacActionController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.2.1
 */
class RbacConditionController extends Controller
{

    /**
     * @param integer|null $rbac_condition_id
     * @param integer|null $rbac_block_id
     * @return string|Response
     */
    public function actionCreate($rbac_condition_id = null, $rbac_block_id = null)
    {
        $model = new RbacCondition();
        $model->rbac_condition_id = $rbac_condition_id;
        $model->logical_operator = $model->rbacConditionParent && !$model->rbacConditionParent->rbacBlock ? $model->rbacConditionParent->logical_operator : null;

        if ($model->rbac_condition_id || (!$model->rbac_condition_id && !$model->rbacCondition)) {
            $model->scenario = RbacCondition::SCENARIO_CHILD;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($rbac_block_id) {
                return $this->redirect([
                    'rbac-block-rbac-condition/create',
                    'rbac_block_id' => $rbac_block_id,
                    'rbac_condition_id' => $model->id
                ]);
            }

            $condition = $model;

            while (true) {
                if ($_condition = $condition->rbacConditionParent) {
                    $condition = $_condition;
                } else {
                    break;
                }
            }

            return $this->redirect(['rbac-block/update', 'id' => $condition->rbacBlock->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->rbac_condition_id || ($model->rbacBlock && $model->rbacBlock->getRbacBlockRbacConditions()->one()->rbac_condition_id !== $model->id)) {
            $model->scenario = RbacCondition::SCENARIO_CHILD;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $condition = $model;

            while (true) {
                if ($_condition = $condition->rbacConditionParent) {
                    $condition = $_condition;
                } else {
                    break;
                }
            }

            return $this->redirect(['rbac-block/update', 'id' => $condition->rbacBlock->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @param integer $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $condition = $model = self::findModel($id);

        while (true) {
            if ($_condition = $condition->rbacConditionParent) {
                $condition = $_condition;
            } else {
                break;
            }
        }

        $block_id = $condition->rbacBlock->id;

        $model->delete();

        return $this->redirect(['rbac-block/update', 'id' => $condition->rbacBlock->id]);
    }

    /**
     * @param integer $id
     * @return RbacCondition
     * @throws NotFoundHttpException
     */
    public static function findModel($id)
    {
        if (($model = RbacCondition::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
