<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacControllerQuery;
use antonyz89\rbac\models\query\RbacProfileQuery;
use antonyz89\rbac\models\query\RbacProfileRbacControllerQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rbac_profile".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RbacController[] $rbacControllers
 * @property RbacProfileRbacController[] $rbacProfileRbacControllers
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
     * Gets query for [[RbacControllers]].
     *
     * @return ActiveQuery|RbacControllerQuery
     */
    public function getRbacControllers()
    {
        return $this->hasMany(RbacController::className(), ['id' => 'rbac_controller_id'])->viaTable('rbac_profile_rbac_controller', ['rbac_profile_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfileRbacControllers]].
     *
     * @return ActiveQuery|RbacProfileRbacControllerQuery
     */
    public function getRbacProfileRbacControllers()
    {
        return $this->hasMany(RbacProfileRbacController::className(), ['rbac_profile_id' => 'id'])->with('rbacController');
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
