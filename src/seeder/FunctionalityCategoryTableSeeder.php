<?php

namespace antonyz89\rbac\seeder;

use antonyz89\seeder\TableSeeder;
use common\models\FunctionalityCategory;
use yii\base\NotSupportedException;
use yii\db\Exception;

/**
 * Handles the creation of seeder `{{%functionality_category}}`.
 */
class FunctionalityCategoryTableSeeder extends TableSeeder
{

    /**
     * {@inheritdoc}
     *
     * @throws NotSupportedException|Exception
     */
    function run()
    {
        $this->batchInsert(
            FunctionalityCategory::tableName(),
            ['name', 'created_at', 'updated_at'],
            [
                ['Funcionalidades de Geral', time(), time()],
                ['Funcionalidades de Conta', time(), time()],
                ['Funcionalidades de Administrador', time(), time()],
                ['Funcionalidades de Categoria', time(), time()],
                ['Funcionalidades de Produto', time(), time()],
                ['Funcionalidades de Usuário', time(), time()],
                ['Funcionalidades de Cliente', time(), time()],
                ['Funcionalidades de Empresa', time(), time()],
                ['Funcionalidades de Entregador', time(), time()],
                ['Funcionalidades de Subcategoria', time(), time()],
                ['Funcionalidades de Compra', time(), time()],
                ['Funcionalidades de Pedido', time(), time()],
                ['Funcionalidades de Perfil', time(), time()]
            ]
        );
    }
}
