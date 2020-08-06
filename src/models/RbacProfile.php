<?php

namespace antonyz89\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rbac_profile".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RbacFunctionality[] $rbacFunctionalities
 * @property RbacProfileRbacFunctionality[] $rbacProfileRbacFunctionalities
 */
class RbacProfile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_profile';
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
            [['name', 'description'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
        ];
    }

    /**
     * Gets query for [[RbacFunctionalities]].
     *
     * @return ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionalities()
    {
        return $this->hasMany(RbacFunctionality::className(), ['id' => 'rbac_functionality_id'])->viaTable('rbac_profile_rbac_functionality', ['rbac_profile_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfileRbacFunctionalities]].
     *
     * @return ActiveQuery|RbacProfileRbacFunctionalityQuery
     */
    public function getRbacProfileRbacFunctionalities()
    {
        return $this->hasMany(RbacProfileRbacFunctionality::className(), ['rbac_profile_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacProfileQuery(get_called_class());
    }
}
