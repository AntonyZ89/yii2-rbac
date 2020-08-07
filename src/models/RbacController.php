<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacActionQuery;
use antonyz89\rbac\models\query\RbacControllerQuery;
use antonyz89\rbac\models\query\RbacFunctionalityQuery;
use antonyz89\rbac\models\query\RbacProfileQuery;
use antonyz89\rbac\models\query\RbacProfileRbacControllerQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rbac_controller".
 *
 * @property int $id
 * @property string $name
 * @property string $application
 * @property int $created_at
 * @property int $updated_at
 *
 * @property-read RbacAction[] $rbacActions
 * @property-read RbacProfileRbacController[] $rbacProfileRbacControllers
 * @property-read RbacFunctionality[] $rbacFunctionalities
 * @property-read RbacProfile[] $rbacProfiles
 */
class RbacController extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_controller';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'application'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'application'], 'string', 'max' => 255],
            [['name', 'application'], 'unique', 'targetAttribute' => ['name', 'application']],
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
            'application' => Yii::t('app', 'Application'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacActions]].
     *
     * @return ActiveQuery|RbacActionQuery
     */
    public function getRbacActions()
    {
        return $this->hasMany(RbacAction::className(), ['rbac_controller_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfileRbacControllers]].
     *
     * @return ActiveQuery|RbacProfileRbacControllerQuery
     */
    public function getRbacProfileRbacControllers()
    {
        return $this->hasMany(RbacProfileRbacController::className(), ['rbac_controller_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfiles]].
     *
     * @return ActiveQuery|RbacProfileQuery
     */
    public function getRbacProfiles()
    {
        return $this->hasMany(RbacProfile::className(), ['id' => 'rbac_profile_id'])->via('rbacProfileRbacControllers');
    }

    /**
     * Gets query for [[RbacFunctionalities]].
     *
     * @return ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionalities()
    {
        return $this->hasMany(RbacFunctionality::className(), ['rbac_profile_id' => 'rbac_profile_id', 'rbac_controller_id' => 'rbac_controller_id'])->via('rbacProfileRbacControllers');
    }

    /**
     * {@inheritdoc}
     * @return RbacControllerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacControllerQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
