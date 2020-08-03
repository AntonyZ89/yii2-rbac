<?php


namespace antonyz89\rbac\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Action
 * @package antonyz89\rbac
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 1.0
 *
 * @property string $id
 * @property string $route
 * @property integer $created_at
 * @property integer $update_at
 */
class Action extends ActiveRecord
{
    public $id;
    public $route;

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%rbac_action}}';
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    public function rules()
    {
        [['route'], 'required'];
        [['route'], 'string'];
        [['updated_at', 'created_at'], 'integer'];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'route' => Yii::t('app', 'Route'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At')
        ];
    }
}
