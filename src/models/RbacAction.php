<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\base\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

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
class RbacAction extends ActiveRecord
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
            'rbac_controller_id' => Yii::t('app', 'Rbac Controller ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacController]].
     *
     * @return \yii\db\ActiveQuery|RbacControllerQuery
     */
    public function getRbacController()
    {
        return $this->hasOne(RbacController::className(), ['id' => 'rbac_controller_id']);
    }

    /**
     * Gets query for [[RbacFunctionalities]].
     *
     * @return \yii\db\ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionalities()
    {
        return $this->hasMany(RbacFunctionality::className(), ['id' => 'rbac_functionality_id'])->viaTable('rbac_functionality_rbac_action', ['rbac_action_id' => 'id']);
    }

    /**
     * Gets query for [[RbacFunctionalityRbacActions]].
     *
     * @return \yii\db\ActiveQuery|RbacFunctionalityRbacActionQuery
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
}
