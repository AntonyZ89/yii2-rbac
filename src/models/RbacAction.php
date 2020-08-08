<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacActionQuery;
use antonyz89\rbac\models\query\RbacControllerQuery;
use antonyz89\rbac\models\query\RbacFunctionalityQuery;
use antonyz89\rbac\models\query\RbacFunctionalityRbacActionQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "rbac_action".
 *
 * @property int $id
 * @property int $rbac_controller_id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RbacController $rbacController
 * @property RbacFunctionality[] $rbacFunctionalities
 * @property RbacFunctionalityRbacAction[] $rbacFunctionalityRbacActions
 */
class RbacAction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_action';
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
            [['rbac_controller_id', 'name'], 'required'],
            [['rbac_controller_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['rbac_controller_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacController::className(), 'targetAttribute' => ['rbac_controller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rbac_controller_id' => Yii::t('app', 'Controller'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacController]].
     *
     * @return ActiveQuery|RbacControllerQuery
     */
    public function getRbacController()
    {
        return $this->hasOne(RbacController::className(), ['id' => 'rbac_controller_id']);
    }

    /**
     * Gets query for [[RbacFunctionalities]].
     *
     * @return ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionalities()
    {
        return $this->hasMany(RbacFunctionality::className(), ['id' => 'rbac_functionality_id'])->via('rbacFunctionalityRbacActions');
    }

    /**
     * Gets query for [[RbacFunctionalityRbacActions]].
     *
     * @return ActiveQuery|RbacFunctionalityRbacActionQuery
     */
    public function getRbacFunctionalityRbacActions()
    {
        return $this->hasMany(RbacFunctionalityRbacAction::className(), ['rbac_action_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacActionQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
