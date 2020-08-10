<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacBlockQuery;
use antonyz89\rbac\models\query\RbacBlockRbacConditionQuery;
use antonyz89\rbac\models\query\RbacConditionQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rbac_block_rbac_condition".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.2.1
 *
 * @property int $rbac_block_id
 * @property int $rbac_condition_id
 * @property int $created_at
 *
 * @property RbacBlock $rbacBlock
 * @property RbacCondition $rbacCondition
 *
 */
class RbacBlockRbacCondition extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_block_rbac_condition';
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
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rbac_block_id', 'rbac_condition_id'], 'required'],
            [['rbac_block_id', 'rbac_condition_id', 'created_at'], 'integer'],
            [['rbac_block_id', 'rbac_condition_id'], 'unique', 'targetAttribute' => ['rbac_block_id', 'rbac_condition_id']],
            [['rbac_block_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacBlock::className(), 'targetAttribute' => ['rbac_block_id' => 'id']],
            [['rbac_condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacCondition::className(), 'targetAttribute' => ['rbac_condition_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rbac_block_id' => Yii::t('app', 'Rbac Block ID'),
            'rbac_condition_id' => Yii::t('app', 'Rbac Condition ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[RbacBlock]].
     *
     * @return ActiveQuery|RbacBlockQuery
     */
    public function getRbacBlock()
    {
        return $this->hasOne(RbacBlock::className(), ['id' => 'rbac_block_id']);
    }

    /**
     * Gets query for [[RbacCondition]].
     *
     * @return ActiveQuery|RbacConditionQuery
     */
    public function getRbacCondition()
    {
        return $this->hasOne(RbacCondition::className(), ['id' => 'rbac_condition_id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacBlockRbacConditionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacBlockRbacConditionQuery(get_called_class());
    }
}
