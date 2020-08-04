<?php


namespace antonyz89\rbac\models\base;


use yii\helpers\Inflector;
use \yii\db\ActiveRecord as ActiveRecordBase;

/**
 * Class ActiveRecord
 * @package antonyz89\rbac\models\base
 *
 * @author Antony Gabriel <antonyz.dev@gmail.com>
 * @since 1.0
 *
 * @property-read mixed $camelName
 */
class ActiveRecord extends ActiveRecordBase
{
    protected $_camel_name;

    /**
     * @return mixed
     */
    public function getCamelName()
    {
        if ($this->_camel_name !== null) {
            return $this->_camel_name;
        }

        return $this->_camel_name = Inflector::camelize($this->name);
    }

}
