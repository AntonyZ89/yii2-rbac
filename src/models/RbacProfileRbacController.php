<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacControllerQuery;
use antonyz89\rbac\models\query\RbacBlockQuery;
use antonyz89\rbac\models\query\RbacProfileQuery;
use antonyz89\rbac\models\query\RbacProfileRbacControllerQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "rbac_profile_rbac_controller".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 *
 * @property int $rbac_profile_id
 * @property int $rbac_controller_id
 * @property int $created_at
 *
 * @property RbacController $rbacController
 * @property RbacBlock[] $rbacBlocks
 * @property RbacProfile $rbacProfile
 */
class RbacProfileRbacController extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_profile_rbac_controller';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rbac_profile_id', 'rbac_controller_id'], 'required'],
            [['rbac_profile_id', 'rbac_controller_id', 'created_at'], 'integer'],
            [['rbac_profile_id', 'rbac_controller_id'], 'unique', 'targetAttribute' => ['rbac_profile_id', 'rbac_controller_id']],
            [['rbac_controller_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacController::className(), 'targetAttribute' => ['rbac_controller_id' => 'id']],
            [['rbac_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacProfile::className(), 'targetAttribute' => ['rbac_profile_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rbac_profile_id' => Yii::t('app', 'Profile'),
            'rbac_controller_id' => Yii::t('app', 'Controller'),
            'created_at' => Yii::t('app', 'Created At'),
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
     * Gets query for [[RbacBlocks]].
     *
     * @return ActiveQuery|RbacBlockQuery
     */
    public function getRbacBlocks()
    {
        return $this->hasMany(RbacBlock::className(), ['rbac_profile_id' => 'rbac_profile_id', 'rbac_controller_id' => 'rbac_controller_id']);
    }

    /**
     * Gets query for [[RbacProfile]].
     *
     * @return ActiveQuery|RbacProfileQuery
     */
    public function getRbacProfile()
    {
        return $this->hasOne(RbacProfile::className(), ['id' => 'rbac_profile_id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacProfileRbacControllerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacProfileRbacControllerQuery(get_called_class());
    }
}
