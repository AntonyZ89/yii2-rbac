<?php

namespace antonyz89\rbac\seeder;

use antonyz89\seeder\TableSeeder;
use common\models\Functionality;
use common\models\FunctionalityCategory;
use yii\helpers\ArrayHelper;

/**
 * Handles the creation of seeder `{{%functionality}}`.
 */
class FunctionalityTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    function run()
    {
        $this->disableForeignKeyChecks();
        $this->truncateTable(Functionality::tableName());
        $this->enableForeignKeyChecks();

        $categories = ArrayHelper::map(FunctionalityCategory::find()->all(), 'name', 'id');

        $functionalitiesByCategory = [
            "Funcionalidades de Geral" => [
                [
                    'rule' => Functionality::IS_ADMIN,
                    'name' => "Administrador do Sistema",
                    'description' => "Possibilita a visualização das informações de administrador do sistema."
                ],
                [
                    'rule' => Functionality::VIEW_DASHBOARD,
                    'name' => "Visualizar Dashboard",
                    'description' => "Possibilita a visualização das informações da Dashboard."
                ],
            ],
            "Funcionalidades de Conta" => [
                [
                    'rule' => Functionality::ACCOUNT_MANAGE,
                    'name' => "Gerenciar Conta",
                    'description' => "Possibilita a adição, edição e ativação/inativação de contas."
                ],
                [
                    'rule' => Functionality::ACCOUNT_VIEW,
                    'name' => "Visualizar Conta",
                    'description' => "Possibilita a visualização das contas cadastradas no sistema."
                ]
            ],
            "Funcionalidades de Administrador" => [
                [
                    'rule' => Functionality::ADMIN_MANAGE,
                    'name' => "Gerenciar Administrador",
                    'description' => "Possibilita a adição, edição e ativação/inativação de administradores."
                ],
                [
                    'rule' => Functionality::ADMIN_VIEW,
                    'name' => "Visualizar Administrador",
                    'description' => "Possibilita a visualização dos administradores cadastrados no sistema."
                ]
            ],
            "Funcionalidades de Categoria" => [
                [
                    'rule' => Functionality::CATEGORY_MANAGE,
                    'name' => "Gerenciar Categoria",
                    'description' => "Possibilita a adição, edição de categorias."
                ],
                [
                    'rule' => Functionality::CATEGORY_VIEW,
                    'name' => "Visualizar Categoria",
                    'description' => "Possibilita a visualização das categorias cadastradas no sistema."
                ],
                [
                    'rule' => Functionality::CATEGORY_DELETE,
                    'name' => "Remover Categoria",
                    'description' => "Possibilita a remoção definitiva de categorias."
                ],
            ],
            "Funcionalidades de Produto" => [
                [
                    'rule' => Functionality::PRODUCT_MANAGE,
                    'name' => "Gerenciar Produto",
                    'description' => "Possibilita a adição, edição de produtos."
                ],
                [
                    'rule' => Functionality::PRODUCT_VIEW,
                    'name' => "Visualizar Produto",
                    'description' => "Possibilita a visualização dos produtos cadastrados no sistema."
                ],
                [
                    'rule' => Functionality::PRODUCT_DELETE,
                    'name' => "Remover Produto",
                    'description' => "Possibilita a remoção definitiva de produtos."
                ],
            ],
            "Funcionalidades de Usuário" => [
                [
                    'rule' => Functionality::USER_MANAGE,
                    'name' => "Gerenciar Usuário",
                    'description' => "Possibilita a adição, edição de usuários."
                ],
                [
                    'rule' => Functionality::USER_VIEW,
                    'name' => "Visualizar Usuário",
                    'description' => "Possibilita a visualização dos usuários cadastrados no sistema."
                ],
                [
                    'rule' => Functionality::USER_DELETE,
                    'name' => "Remover Usuário",
                    'description' => "Possibilita a remoção definitiva de usuários."
                ],
            ],
            "Funcionalidades de Cliente" => [
                [
                    'rule' => Functionality::CLIENT_MANAGE,
                    'name' => "Gerenciar Cliente",
                    'description' => "Possibilita a adição, edição de clientes."
                ],
                [
                    'rule' => Functionality::CLIENT_VIEW,
                    'name' => "Visualizar Cliente",
                    'description' => "Possibilita a visualização dos clientes cadastradas no sistema."
                ],
                [
                    'rule' => Functionality::CLIENT_DELETE,
                    'name' => "Remover Cliente",
                    'description' => "Possibilita a remoção definitiva de clientes."
                ],
            ],
            "Funcionalidades de Empresa" => [
                [
                    'rule' => Functionality::COMPANY_MANAGE,
                    'name' => "Gerenciar Empresa",
                    'description' => "Possibilita a adição, edição de empresas."
                ],
                [
                    'rule' => Functionality::COMPANY_VIEW,
                    'name' => "Visualizar Empresa",
                    'description' => "Possibilita a visualização das empresas cadastradas no sistema."
                ],
                [
                    'rule' => Functionality::COMPANY_DELETE,
                    'name' => "Remover Empresa",
                    'description' => "Possibilita a remoção definitiva de empresas."
                ],
            ],
            "Funcionalidades de Entregador" => [
                [
                    'rule' => Functionality::DELIVERYMAN_MANAGE,
                    'name' => "Gerenciar Entregador",
                    'description' => "Possibilita a adição, edição de entregadores."
                ],
                [
                    'rule' => Functionality::DELIVERYMAN_VIEW,
                    'name' => "Visualizar Entregador",
                    'description' => "Possibilita a visualização dos entregadores cadastrados no sistema."
                ],
                [
                    'rule' => Functionality::DELIVERYMAN_DELETE,
                    'name' => "Remover Entregador",
                    'description' => "Possibilita a remoção definitiva de entregadores."
                ],
            ],
            "Funcionalidades de Subcategoria" => [
                [
                    'rule' => Functionality::SUBCATEGORY_MANAGE,
                    'name' => "Gerenciar Subcategoria",
                    'description' => "Possibilita a adição, edição de subcategorias."
                ],
                [
                    'rule' => Functionality::SUBCATEGORY_VIEW,
                    'name' => "Visualizar Subcategoria",
                    'description' => "Possibilita a visualização das subcategorias cadastradas no sistema."
                ],
                [
                    'rule' => Functionality::SUBCATEGORY_DELETE,
                    'name' => "Remover Subcategoria",
                    'description' => "Possibilita a remoção definitiva de subcategorias."
                ],
            ],
            "Funcionalidades de Compra" => [
                [
                    'rule' => Functionality::ORDER_VIEW,
                    'name' => "Visualizar Compra",
                    'description' => "Possibilita a visualização das compras cadastradas no sistema."
                ],
            ],
            "Funcionalidades de Pedido" => [
                [
                    'rule' => Functionality::ORDER_MANAGE,
                    'name' => "Gerenciar Pedido",
                    'description' => "Possibilita a visualização e seleção de um entregador para uma compra."
                ]
            ],
            "Funcionalidades de Perfil" => [
                [
                    'rule' => Functionality::PROFILE_MANAGE,
                    'name' => "Gerenciar Perfil",
                    'description' => "Possibilita a adição, edição de perfis."
                ],
                [
                    'rule' => Functionality::PROFILE_VIEW,
                    'name' => "Visualizar Perfil",
                    'description' => "Possibilita a visualização dos perfis cadastrados no sistema."
                ],
                [
                    'rule' => Functionality::PROFILE_DELETE,
                    'name' => "Remover Perfil",
                    'description' => "Possibilita a remoção definitiva de perfis."
                ],
            ],
        ];

        $inserts = [];

        foreach ($functionalitiesByCategory as $category => $functionalities) {
            $category = $categories[$category];
            foreach ($functionalities as $functionality) {
                $inserts[] = [$category, $functionality['rule'], $functionality['name'], $functionality['description'], time(), time()];
            }
        }

        $this->batchInsert(Functionality::tableName(), ['functionality_category_id', 'rule', 'name', 'description', 'created_at', 'updated_at'], $inserts);
    }
}
