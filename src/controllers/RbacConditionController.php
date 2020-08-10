<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacBlock;
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

        if ($rbac_condition_id) {
            $model->scenario = RbacCondition::SCENARIO_CHILD;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($rbac_block_id) {
                return $this->redirect(['rbac-block-rbac-condition/create', 'rbac_block_id' => $rbac_block_id, 'rbac_condition_id' => $model->id]);
            }

            return $this->redirect(['rbac-block/update', 'id' => $model->rbacBlock->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['rbac-block/update', 'id' => $model->rbacBlock->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
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
