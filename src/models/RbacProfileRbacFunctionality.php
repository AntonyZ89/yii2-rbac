<?php

namespace antonyz89\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "rbac_profile_rbac_functionality".
 *
 * @property int $rbac_profile_id
 * @property int $rbac_functionality_id
 * @property int $created_at
 *
 * @property RbacFunctionality $rbacFunctionality
 * @property RbacProfile $rbacProfile
 */
class RbacProfileRbacFunctionality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_profile_rbac_functionality';
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
            [['rbac_profile_id', 'rbac_functionality_id'], 'required'],
            [['rbac_profile_id', 'rbac_functionality_id', 'created_at'], 'integer'],
            [['rbac_profile_id', 'rbac_functionality_id'], 'unique', 'targetAttribute' => ['rbac_profile_id', 'rbac_functionality_id']],
            [['rbac_functionality_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacFunctionality::className(), 'targetAttribute' => ['rbac_functionality_id' => 'id']],
            [['rbac_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacProfile::className(), 'targetAttribute' => ['rbac_profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rbac_profile_id' => Yii::t('app', 'Rbac Profile ID'),
            'rbac_functionality_id' => Yii::t('app', 'Rbac Functionality ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[RbacFunctionality]].
     *
     * @return \yii\db\ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionality()
    {
        return $this->hasOne(RbacFunctionality::className(), ['id' => 'rbac_functionality_id']);
    }

    /**
     * Gets query for [[RbacProfile]].
     *
     * @return \yii\db\ActiveQuery|RbacProfileQuery
     */
    public function getRbacProfile()
    {
        return $this->hasOne(RbacProfile::className(), ['id' => 'rbac_profile_id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacProfileRbacFunctionalityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacProfileRbacFunctionalityQuery(get_called_class());
    }
}
