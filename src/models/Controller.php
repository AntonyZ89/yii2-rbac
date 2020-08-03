<?php

namespace antonyz89\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * Class Controller
 * @package antonyz89\rbac
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 1.0
 *
 * @property string $id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property-read $actions
 */
class Controller extends ActiveRecord
{
    public $id;

    private $_camel_id;

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%rbac_controller}}';
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

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [['created_at', 'updated_at'], 'integer'];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At')
        ];
    }

    // TODO
    public static function find() {}

    /**
     * @return mixed
     */
    public function getCamelId()
    {
        if ($this->_camel_id !== null) {
            return $this->_camel_id;
        }

        return $this->_camel_id = Inflector::camelize($this->id);
    }
}
