<?php

namespace antonyz89\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "rbac_functionality".
 *
 * @property int $id
 * @property int $controller_id
 * @property string $rule
 * @property string $name
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RbacController $controller
 * @property RbacAction[] $rbacActions
 * @property RbacFunctionalityRbacAction[] $rbacFunctionalityRbacActions
 * @property RbacProfileRbacFunctionality[] $rbacProfileRbacFunctionalities
 * @property RbacProfile[] $rbacProfiles
 */
class RbacFunctionality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_functionality';
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
            [['controller_id', 'rule', 'name', 'description'], 'required'],
            [['controller_id', 'created_at', 'updated_at'], 'integer'],
            [['rule', 'name', 'description'], 'string', 'max' => 255],
            [['controller_id', 'rule', 'name'], 'unique', 'targetAttribute' => ['controller_id', 'rule', 'name']],
            [['controller_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacController::className(), 'targetAttribute' => ['controller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'controller_id' => Yii::t('app', 'Controller ID'),
            'rule' => Yii::t('app', 'Rule'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Controller]].
     *
     * @return \yii\db\ActiveQuery|RbacControllerQuery
     */
    public function getController()
    {
        return $this->hasOne(RbacController::className(), ['id' => 'controller_id']);
    }

    /**
     * Gets query for [[RbacActions]].
     *
     * @return \yii\db\ActiveQuery|RbacActionQuery
     */
    public function getRbacActions()
    {
        return $this->hasMany(RbacAction::className(), ['id' => 'rbac_action_id'])->viaTable('rbac_functionality_rbac_action', ['rbac_functionality_id' => 'id']);
    }

    /**
     * Gets query for [[RbacFunctionalityRbacActions]].
     *
     * @return \yii\db\ActiveQuery|RbacFunctionalityRbacActionQuery
     */
    public function getRbacFunctionalityRbacActions()
    {
        return $this->hasMany(RbacFunctionalityRbacAction::className(), ['rbac_functionality_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfileRbacFunctionalities]].
     *
     * @return \yii\db\ActiveQuery|RbacProfileRbacFunctionalityQuery
     */
    public function getRbacProfileRbacFunctionalities()
    {
        return $this->hasMany(RbacProfileRbacFunctionality::className(), ['rbac_functionality_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfiles]].
     *
     * @return \yii\db\ActiveQuery|RbacProfileQuery
     */
    public function getRbacProfiles()
    {
        return $this->hasMany(RbacProfile::className(), ['id' => 'rbac_profile_id'])->viaTable('rbac_profile_rbac_functionality', ['rbac_functionality_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacFunctionalityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacFunctionalityQuery(get_called_class());
    }
}
