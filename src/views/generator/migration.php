<?php
/**
 * This view is used by antonyz89/rbac/controllers/GeneratorController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
/* @var $rbac_data array */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}

function encode(array $array) {
    return str_replace(',', ', ', substr(json_encode($array), 1, -1));
}
?>

use yii\db\Migration;

/**
 * Class <?= $className . "\n" ?>
 */
class <?= $className ?> extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->disableForeignKeyChecks();
        $this->truncateTables([
        <?php foreach($rbac_data as $data): ?>
    '<?= array_shift($data) ?>',
        <?php endforeach; ?>
]);
        <?php foreach ($rbac_data as $data): ?>

        $this->batchInsert('<?= array_shift($data) ?>', [<?= encode(array_shift($data)) ?>], [
            <?= implode(",\n\t\t\t", array_map(static function ($value) {
                    return '[' . encode($value) . ']';
                }, $data)) ?>
        <?= "\n" ?>
        ]);
        <?php endforeach; ?>

        $this->enableForeignKeyChecks();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "<?= $className ?> cannot be reverted.\n";

        return false;
    }

    /**
    * @throws Exception
    */
    public function disableForeignKeyChecks()
    {
        Yii::$app->db->createCommand()->checkIntegrity(false)->execute();
    }

    /**
    * @throws Exception
    */
    public function enableForeignKeyChecks()
    {
        Yii::$app->db->createCommand()->checkIntegrity(true)->execute();
    }

    public function truncateTables(array $tables) {
        foreach($tables as $table) {
            $this->truncateTable($table);
        }
    }
}
