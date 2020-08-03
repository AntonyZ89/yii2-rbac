<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%functionality}}".
 *
 * @property int $id
 * @property string $rule
 * @property string $name
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 * @property int $functionality_category_id
 *
 * @property FunctionalityCategory $functionalityCategory
 */
class Functionality extends ActiveRecord
{

    /** @see FunctionalityTableSeeder */

    /*

                -*-*- Example -*-*-

    public const IS_ADMIN = 'isAdmin';
    public const VIEW_DASHBOARD = 'viewDashboard';

    public const ACCOUNT_MANAGE = 'manageAccount';
    public const ACCOUNT_VIEW = 'viewAccount';

    public const ADMIN_MANAGE = 'manageAdmin';
    public const ADMIN_VIEW = 'viewAdmin';

    public const CATEGORY_MANAGE = 'manageCategory';
    public const CATEGORY_DELETE = 'deleteCategory';
    public const CATEGORY_VIEW = 'viewCategory';

    public const PRODUCT_MANAGE = 'manageProduct';
    public const PRODUCT_DELETE = 'deleteProduct';
    public const PRODUCT_VIEW = 'viewProduct';

    public const USER_MANAGE = 'manageUser';
    public const USER_DELETE = 'deleteUser';
    public const USER_VIEW = 'viewUser';

    public const CLIENT_MANAGE = 'manageClient';
    public const CLIENT_DELETE = 'deleteClient';
    public const CLIENT_VIEW = 'viewClient';

    public const COMPANY_MANAGE = 'manageCompany';
    public const COMPANY_DELETE = 'deleteCompany';
    public const COMPANY_VIEW = 'viewCompany';

    public const SUBCATEGORY_MANAGE = 'manageSubcategory';
    public const SUBCATEGORY_DELETE = 'deleteSubcategory';
    public const SUBCATEGORY_VIEW = 'viewSubcategory';

    public const DELIVERYMAN_MANAGE = 'manageDeliveryman';
    public const DELIVERYMAN_DELETE = 'deleteDeliveryman';
    public const DELIVERYMAN_VIEW = 'viewDeliveryman';

    public const ORDER_MANAGE = 'manageOrder';
    public const ORDER_VIEW = 'viewOrder';

    public const PROFILE_MANAGE = 'manageProfile';
    public const PROFILE_DELETE = 'deleteProfile';
    public const PROFILE_VIEW = 'viewProfile';
    */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%functionality}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'rule', 'description', 'created_at', 'updated_at', 'functionality_category_id'], 'required'],
            [['created_at', 'updated_at', 'deleted_at', 'functionality_category_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['rule', 'string', 'max' => 30]],
            [['functionality_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => FunctionalityCategory::className(), 'targetAttribute' => ['functionality_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'functionality_category_id' => Yii::t('app', 'Functionality Category ID'),
        ];
    }

    /**
     * Gets query for [[FunctionalityCategory]].
     *
     * @return \yii\db\ActiveQuery|FunctionalityCategoryQuery
     */
    public function getFunctionalityCategory()
    {
        return $this->hasOne(FunctionalityCategory::className(), ['id' => 'functionality_category_id']);
    }

    /**
     * {@inheritdoc}
     * @return FunctionalityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FunctionalityQuery(get_called_class());
    }

    public static function list()
    {
        $result = [];

        $functionalityCategories = FunctionalityCategory::find()->all();
        foreach ($functionalityCategories as $category) {
            $result[$category->name] = $category->toArray()['functionalities'];
        }

        return $result;
    }

    public function __toString()
    {
        return "$this->name\n$this->description";
    }
}
