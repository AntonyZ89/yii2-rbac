<?php

namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacController;
use antonyz89\rbac\models\RbacProfile;
use antonyz89\rbac\models\RbacProfileRbacController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class RbacControllerController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 */
class RbacControllerController extends Controller
{
    /**
     * @param integer $rbac_profile_id
     * @param string|null $q
     * @return array
     */
    public function actionSearch($rbac_profile_id, $q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $controller_ids = RbacProfileRbacController::find()
            ->select('rbac_controller_id')
            ->whereRbacProfile($rbac_profile_id);

        $query = RbacController::find()
            ->whereId($controller_ids, 'NOT IN')
            ->search($q);

        $results = ArrayHelper::getColumn($query->limit(20)->all(), static function (RbacController $model) {
            return [
                'id' => $model->id,
                'text' => (string)$model
            ];
        });

        return ['results' => $results];
    }

    /**
     * @param integer $id
     * @return RbacProfile
     * @throws NotFoundHttpException
     */
    public static function findProfileModel($id)
    {
        if (($model = RbacProfile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
