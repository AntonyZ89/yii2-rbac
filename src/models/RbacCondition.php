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
 * This is the model class for table "rbac_condition".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.2.1
 *
 * @property int $id
 * @property int|null $rbac_condition_id
 * @property string $param
 * @property int $operator
 * @property string $value
 * @property int $logical_operator
 * @property int $created_at
 * @property int $updated_at
 *
 * @property-read RbacBlockRbacCondition $rbacBlockRbacCondition
 * @property-read RbacBlock $rbacBlock
 * @property-read RbacCondition $rbacCondition
 * @property-read RbacCondition $rbacCondition0
 * @property-read string $operatorText
 * @property-read string $logicalOperatorText
 *
 */
class RbacCondition extends ActiveRecord
{

    public const OPERATOR_EQUAL_TO = 1;
    public const OPERATOR_NOT_EQUAL = 2;
    public const OPERATOR_GREATER_THAN = 3;
    public const OPERATOR_LESS_THAN = 4;
    public const OPERATOR_GREATER_THAN_OR_EQUAL_TO = 5;
    public const OPERATOR_LESS_THAN_OR_EQUAL_TO = 6;

    public const LOGICAL_AND = 1;
    public const LOGICAL_OR = 2;

    public const SCENARIO_CHILD = 'child';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_condition';
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
            [['rbac_condition_id', 'operator', 'logical_operator', 'created_at', 'updated_at'], 'integer'],
            [['param', 'operator', 'value'], 'required'],
            [['operator'], 'in', 'range' => array_keys(self::valuesOperator())],
            [['logical_operator'], 'in', 'range' => array_keys(self::valuesLogicalOperator())],
            [['logical_operator'], 'required', 'on' => self::SCENARIO_CHILD],
            [['param', 'value'], 'string', 'max' => 255],
            [['rbac_condition_id'], 'unique'],
            [['rbac_condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => self::class, 'targetAttribute' => ['rbac_condition_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rbac_condition_id' => Yii::t('app', 'Rbac Condition ID'),
            'param' => Yii::t('app', 'Param'),
            'operator' => Yii::t('app', 'Operator'),
            'value' => Yii::t('app', 'Value'),
            'logical_operator' => Yii::t('app', 'Logical Operator'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacBlockRbacCondition]].
     *
     * @return ActiveQuery|RbacBlockRbacConditionQuery
     */
    public function getRbacBlockRbacCondition()
    {
        return $this->hasOne(RbacBlockRbacCondition::class, ['rbac_condition_id' => 'id']);
    }

    /**
     * Gets query for [[RbacBlock]].
     *
     * @return ActiveQuery|RbacBlockQuery
     */
    public function getRbacBlock()
    {
        return $this->hasOne(RbacBlock::class, ['id' => 'rbac_block_id'])->viaTable('rbac_block_rbac_condition', ['rbac_condition_id' => 'id']);
    }

    /**
     * Gets query for [[RbacCondition]].
     *
     * @return ActiveQuery|RbacConditionQuery
     */
    public function getRbacCondition()
    {
        return $this->hasOne(self::class, ['id' => 'rbac_condition_id']);
    }

    /**
     * Gets query for [[RbacCondition0]].
     *
     * @return ActiveQuery|RbacConditionQuery
     */
    public function getRbacCondition0()
    {
        return $this->hasOne(self::class, ['rbac_condition_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacConditionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacConditionQuery(get_called_class());
    }

    /**
     * @param integer|null $value
     * @return string|string[]
     */
    public static function valuesOperator($value = null)
    {
        static $values = [
            self::OPERATOR_EQUAL_TO => '==',
            self::OPERATOR_NOT_EQUAL => '!=',
            self::OPERATOR_GREATER_THAN => '>',
            self::OPERATOR_LESS_THAN => '<',
            self::OPERATOR_GREATER_THAN_OR_EQUAL_TO => '>=',
            self::OPERATOR_LESS_THAN_OR_EQUAL_TO => '<='
        ];

        return $value !== null ? $values[$value] : $values;
    }

    /**
     * @param integer|null $value
     * @return string|string[]
     */
    public static function valuesLogicalOperator($value = null)
    {
        static $values = [
            self::LOGICAL_AND => '&&',
            self::LOGICAL_OR => '||'
        ];

        return $value !== null ? $values[$value] : $values;
    }

    /**
     * @return string
     */
    public function getOperatorText()
    {
        return self::valuesOperator($this->operator);
    }

    /**
     * @return string
     */
    public function getLogicalOperatorText()
    {
        return self::valuesLogicalOperator($this->logical_operator);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->logical_operator ? $this->logicalOperatorText . ' ' : null) . "$this->param $this->operatorText $this->value";
    }
}
