<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacAction;
use antonyz89\rbac\models\RbacBlock;
use antonyz89\rbac\models\RbacBlockRbacAction;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacActionController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacActionController extends Controller
{
    /**
     * @param integer $block_id
     * @param string|null $q
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionSearch($block_id, $q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rbacBlock = self::findBlockModel($block_id);

        $action_ids = RbacBlockRbacAction::find()
            ->select('rbac_action_id')
            ->whereRbacBlock($block_id);

        $query = RbacAction::find()
            ->whereRbacController($rbacBlock->rbac_controller_id)
            ->whereId($action_ids, 'NOT IN');

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
     * @return RbacBlock
     * @throws NotFoundHttpException
     */
    public static function findBlockModel($id)
    {
        if (($model = RbacBlock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
