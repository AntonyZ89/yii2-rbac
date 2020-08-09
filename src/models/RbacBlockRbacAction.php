<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacActionQuery;
use antonyz89\rbac\models\query\RbacBlockQuery;
use antonyz89\rbac\models\query\RbacBlockRbacActionQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rbac_block_rbac_action".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 *
 * @property int $rbac_block_id
 * @property int $rbac_action_id
 * @property int $created_at
 *
 * @property RbacAction $rbacAction
 * @property RbacBlock $rbacBlock
 */
class RbacBlockRbacAction extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_block_rbac_action';
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
            [['rbac_block_id', 'rbac_action_id'], 'required'],
            [['rbac_block_id', 'rbac_action_id', 'created_at'], 'integer'],
            [['rbac_block_id', 'rbac_action_id'], 'unique', 'targetAttribute' => ['rbac_block_id', 'rbac_action_id']],
            [['rbac_action_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAction::className(), 'targetAttribute' => ['rbac_action_id' => 'id']],
            [['rbac_block_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacBlock::className(), 'targetAttribute' => ['rbac_block_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rbac_block_id' => Yii::t('app', 'Block'),
            'rbac_action_id' => Yii::t('app', 'Action'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[RbacAction]].
     *
     * @return ActiveQuery|RbacActionQuery
     */
    public function getRbacAction()
    {
        return $this->hasOne(RbacAction::className(), ['id' => 'rbac_action_id']);
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
     * {@inheritdoc}
     * @return RbacBlockRbacActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacBlockRbacActionQuery(get_called_class());
    }
}
