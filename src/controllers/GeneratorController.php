<?php


namespace antonyz89\rbac\controllers;

use antonyz89\rbac\controllers\base\Controller;
use antonyz89\rbac\models\RbacAction;
use antonyz89\rbac\models\RbacController;
use antonyz89\rbac\models\RbacBlock;
use antonyz89\rbac\models\RbacBlockRbacAction;
use antonyz89\rbac\models\RbacProfile;
use antonyz89\rbac\models\RbacProfileRbacController;
use Yii;
use yii\web\Response;

/**
 * Class GeneratorController
 * @package antonyz89\rbac\controllers
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.2
 *
 * @property string $templateFile
 */
class GeneratorController extends Controller
{
    public $templateFile = '@antonyz89/rbac/views/generator/migration.php';

    /**
     * @return Response
     */
    public function actionIndex()
    {
        $this->generateFile();

        return $this->redirect(['rbac-profile/index']);
    }

    public function generateFile()
    {
        $name = 'm' . gmdate('ymd_His') . '_insert_rbac_data';

        $migration_path = Yii::getAlias("@console/migrations/$name.php");

        $content = $this->renderFile($this->templateFile, [
            'className' => $name,
            'rbac_data' => [
                $this->getData(RbacAction::class),
                $this->getData(RbacController::class),
                $this->getData(RbacBlock::class),
                $this->getData(RbacBlockRbacAction::class),
                $this->getData(RbacProfile::class),
                $this->getData(RbacProfileRbacController::class),
            ]
        ]);

        file_put_contents($migration_path, $content);

        Yii::$app->session->setFlash('success', "Migration \"$name\" generated.");
    }

    /**
     * @param string $class
     * @return array
     */
    public function getData($class)
    {
        $values = array_map(static function ($value) {
            return array_values($value);
        }, $class::find()->asArray()->all());

        array_unshift($values, $class::getTableSchema()->columnNames);
        array_unshift($values, $class::tableName());

        return $values;
    }


}
