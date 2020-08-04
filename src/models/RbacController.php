<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\base\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "rbac_controller".
 *
 * @property int $id
 * @property string $name
 * @property string $application
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RbacAction[] $rbacActions
 * @property RbacFunctionality[] $rbacFunctionalities
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
     * @return \yii\db\ActiveQuery|RbacActionQuery
     */
    public function getRbacActions()
    {
        return $this->hasMany(RbacAction::className(), ['rbac_controller_id' => 'id']);
    }

    /**
     * Gets query for [[RbacFunctionalities]].
     *
     * @return \yii\db\ActiveQuery|RbacFunctionalityQuery
     */
    public function getRbacFunctionalities()
    {
        return $this->hasMany(RbacFunctionality::className(), ['controller_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacControllerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacControllerQuery(get_called_class());
    }
}
