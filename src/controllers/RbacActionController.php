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
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class RbacActionController extends Controller
{
    /**
     * @param integer $functionality_id
     * @param string|null $q
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionSearch($functionality_id, $q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rbacFunctionality = self::findFunctionalityModel($functionality_id);

        $action_ids = RbacFunctionalityRbacAction::find()
            ->select('rbac_action_id')
            ->whereRbacFunctionality($functionality_id);

        $query = RbacAction::find()
            ->whereRbacController($rbacFunctionality->rbac_controller_id)
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
     * @return RbacFunctionality
     * @throws NotFoundHttpException
     */
    public static function findFunctionalityModel($id)
    {
        if (($model = RbacFunctionality::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
