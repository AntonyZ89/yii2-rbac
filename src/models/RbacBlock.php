<?php

namespace antonyz89\rbac\models;

use antonyz89\rbac\models\query\RbacActionQuery;
use antonyz89\rbac\models\query\RbacBlockQuery;
use antonyz89\rbac\models\query\RbacBlockRbacActionQuery;
use antonyz89\rbac\models\query\RbacBlockRbacConditionQuery;
use antonyz89\rbac\models\query\RbacConditionQuery;
use antonyz89\rbac\models\query\RbacProfileRbacControllerQuery;
use TRegx\CleanRegex\Pattern;
use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "rbac_block".
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 0.1
 *
 * @property int $id
 * @property int $rbac_profile_id
 * @property int $rbac_controller_id
 * @property string $rule
 * @property string|null $name
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property-read RbacAction[] $rbacActions
 * @property-read RbacBlockRbacAction[] $rbacBlockRbacActions
 * @property-read RbacBlockRbacCondition[] $rbacBlockRbacConditions
 * @property-read RbacCondition[] $rbacConditions
 * @property-read RbacProfileRbacController $rbacProfileRbacController
 * @property-read string $conditionText
 * @property-read int $rbacBlockRbacConditionsCount
 */
class RbacBlock extends ActiveRecord
{

    private $_conditionText;
    private $_rbacBlockRbacConditionsCount;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_block';
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
            [['rbac_profile_id', 'rbac_controller_id', 'rule'], 'required'],
            [['rbac_profile_id', 'rbac_controller_id', 'created_at', 'updated_at'], 'integer'],
            [['rule', 'name', 'description'], 'string', 'max' => 255],
            [['rbac_profile_id', 'rbac_controller_id', 'rule'], 'unique', 'targetAttribute' => ['rbac_profile_id', 'rbac_controller_id', 'rule']],
            [['rbac_profile_id', 'rbac_controller_id', 'name'], 'unique', 'targetAttribute' => ['rbac_profile_id', 'rbac_controller_id', 'name']],
            [['rbac_profile_id', 'rbac_controller_id'], 'exist', 'skipOnError' => true, 'targetClass' => RbacProfileRbacController::className(), 'targetAttribute' => ['rbac_profile_id' => 'rbac_profile_id', 'rbac_controller_id' => 'rbac_controller_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rbac_profile_id' => Yii::t('app', 'Profile'),
            'rbac_controller_id' => Yii::t('app', 'Controller'),
            'rule' => Yii::t('app', 'Rule'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacActions]].
     *
     * @return ActiveQuery|RbacActionQuery
     */
    public function getRbacActions()
    {
        return $this->hasMany(RbacAction::className(), ['id' => 'rbac_action_id'])->via('rbacBlockRbacActions');
    }

    /**
     * Gets query for [[RbacBlockRbacActions]].
     *
     * @return ActiveQuery|RbacBlockRbacActionQuery
     */
    public function getRbacBlockRbacActions()
    {
        return $this->hasMany(RbacBlockRbacAction::className(), ['rbac_block_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getRbacBlockRbacConditionsCount()
    {
        if ($this->_rbacBlockRbacConditionsCount === null) {
            $this->_rbacBlockRbacConditionsCount = (int)$this->getRbacBlockRbacConditions()->count();
        }

        return $this->_rbacBlockRbacConditionsCount;
    }

    /**
     * Gets query for [[RbacBlockRbacConditions]].
     *
     * @return ActiveQuery|RbacBlockRbacConditionQuery
     */
    public function getRbacBlockRbacConditions()
    {
        return $this->hasMany(RbacBlockRbacCondition::className(), ['rbac_block_id' => 'id']);
    }

    /**
     * Gets query for [[RbacConditions]].
     *
     * @return ActiveQuery|RbacConditionQuery
     */
    public function getRbacConditions()
    {
        return $this->hasMany(RbacCondition::className(), ['id' => 'rbac_condition_id'])->viaTable('rbac_block_rbac_condition', ['rbac_block_id' => 'id']);
    }

    /**
     * Gets query for [[RbacProfile]].
     *
     * @return ActiveQuery|RbacProfileRbacControllerQuery
     */
    public function getRbacProfileRbacController()
    {
        return $this->hasOne(RbacProfileRbacController::className(), ['rbac_profile_id' => 'rbac_profile_id', 'rbac_controller_id' => 'rbac_controller_id']);
    }

    /**
     * {@inheritdoc}
     * @return RbacBlockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RbacBlockQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getConditionText()
    {

        if ($this->_conditionText === null) {
            $str = '';

            foreach ($this->rbacBlockRbacConditions as $rbacBlockRbacCondition) {
                $condition = $rbacBlockRbacCondition->rbacCondition;
                $initial_id = $condition->id;

                if ($condition->logical_operator) {
                    $str .= "<br><b>$condition->logicalOperatorText</b><br>";
                }

                $str .= $this->rbacBlockRbacConditionsCount ? '<b>(</b><span class="text-primary">' : '<span class="text-primary">';

                while ($condition) {
                    if ($condition->logical_operator && $condition->id !== $initial_id) {
                        $str .= "</span> <b>$condition->logicalOperatorText</b> <span class='text-primary'>";
                    }
                    $str .= $condition;

                    $condition = $condition->rbacCondition;
                }

                $str .= $this->rbacBlockRbacConditionsCount ? '</span><b>)</b>' : '</span>';
            }

            $this->_conditionText = $str;
        }

        return $this->_conditionText;
    }

    public function isValid(IdentityInterface $user): bool
    {
        $result = true;

        foreach ($this->rbacBlockRbacConditions as $rbacBlockRbacCondition) {
            $current = $condition = $rbacBlockRbacCondition->rbacCondition;

            $result2 = true;

            while ($condition) {
                if (
                    ($condition->logical_operator && !$condition->rbacBlock)
                    &&
                    (
                        ($result2 && $condition->logical_operator === RbacCondition::LOGICAL_OR)
                        ||
                        (!$result2 && $condition->logical_operator === RbacCondition::LOGICAL_AND)
                    )
                ) {
                    break;
                }

                $result2 &= $this->compare($condition->operator, ...$this->values($user, $condition));

                $condition = $condition->rbacCondition;
            }

            $result &= $result2;

            if ($current->logical_operator) {
                if ($result2 && $current->logical_operator === RbacCondition::LOGICAL_OR) {
                    $result = $result2;
                    break;
                }

                if(!$result && $current->logical_operator === RbacCondition::LOGICAL_AND) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @param int $operator
     * @param mixed $value1
     * @param mixed $value2
     * @return bool
     * @throws InvalidConfigException
     */
    protected function compare(int $operator, $value1, $value2): bool
    {
        switch ($operator) {
            case RbacCondition::OPERATOR_EQUAL_TO:
                return $value1 === $value2;
            case RbacCondition::OPERATOR_NOT_EQUAL:
                return $value1 !== $value2;
            case RbacCondition::OPERATOR_GREATER_THAN:
                return $value1 > $value2;
            case RbacCondition::OPERATOR_GREATER_THAN_OR_EQUAL_TO:
                return $value1 >= $value2;
            case RbacCondition::OPERATOR_LESS_THAN:
                return $value1 < $value2;
            case RbacCondition::OPERATOR_LESS_THAN_OR_EQUAL_TO:
                return $value1 <= $value2;
            case RbacCondition::OPERATOR_IN:
                return in_array($value1, $value2, false);
            case RbacCondition::OPERATOR_NOT_IN:
                return !in_array($value1, $value2, false);
            default:
                throw new InvalidConfigException("Wrong operator '$operator'");
        }
    }

    /**
     * @param IdentityInterface $user
     * @param RbacCondition $condition
     * @return array
     */
    protected function values(IdentityInterface $user, RbacCondition $condition): array
    {
        $value1 = $this->extract($user, $condition->param);
        $value2 = $condition->value;

        switch ($condition->value_type) {
            case RbacCondition::VALUE_TYPE_STRING:
                if ($user->hasAttribute($value2) || property_exists($user, $value2)) {
                    $value2 = $this->extract($user, $value2);
                }
                break;
            case RbacCondition::VALUE_TYPE_INTEGER:
            case RbacCondition::VALUE_TYPE_FLOAT:
                if (is_numeric($value2)) {
                    $value2 = $condition->value_type === RbacCondition::VALUE_TYPE_INTEGER ? (int)$value2 : (float)$value2;
                } else {
                    $value2 = $this->extract($user, $value2);
                }
                break;
            case RbacCondition::VALUE_TYPE_BOOLEAN:
                if ($value2 === 'true') {
                    $value2 = true;
                } else if ($value2 === 'false') {
                    $value2 = false;
                } else if (is_numeric($value2)) {
                    $value2 = (bool)$value2;
                } else {
                    $value2 = $this->extract($user, $value2);
                }
                break;
            case RbacCondition::VALUE_TYPE_ARRAY:
                try {
                    if (is_array($result = eval($value2))) {
                        $value2 = $result;
                    }
                } catch (\Exception $e) {
                    $value2 = $this->extract($user, $value2);
                }
                break;
        }

        return [$value1, $value2];
    }

    /**
     * Get value from object using dot notation
     *
     * @param IdentityInterface $user
     * @param string $condition
     * @return mixed
     */
    protected function extract(IdentityInterface $user, string $condition)
    {
        $condition = Pattern::of('^(\w+\.)+\w+$')->test($condition) ? explode('.', $condition) : [$condition];

        foreach ($condition as $attr) {
            $user = $user->$attr;
        }

        return $user;
    }
}
