<?php

namespace common\models;

use antonyz89\ManyToMany\behaviors\ManyToManyBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $active
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property Functionality[] $functionalities
 * @property ProfileFunctionality[] $profileFunctionalities
 * @property array $functionality_multiples
 */
class Profile extends ActiveRecord
{

    public $functionality_multiples;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    [
                        'editableAttribute' => 'functionality_multiples', // Editable attribute name
                        'modelClass' => ProfileFunctionality::class, // Model of the junction table
                        'ownAttribute' => 'profile_id', // Name of the column in junction table that represents current model
                        'relatedModel' => Functionality::class, // Related model class
                        'relatedAttribute' => 'functionality_id', // Name of the column in junction table that represents related model
                    ],
                ],
            ]

        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //description
            ['description', 'required'],
            ['description', 'string', 'max' => 255],
            //name
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            //created_at
            ['created_at', 'integer'],
            //updated_at
            ['updated_at', 'integer'],
            //deleted_at
            ['deleted_at', 'integer'],
            [['functionality_multiples'], 'each', 'rule' => ['exist', 'skipOnError' => true, 'targetClass' => Functionality::class, 'targetAttribute' => ['functionality_multiples' => 'id']]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => 'Nome',
            'description' => 'Descrição',
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),

            'functionality_multiples' => 'Funcionalidades',
        ];
    }

    /**
     * Gets query for [[Functionalities]].
     *
     * @return ActiveQuery|FunctionalityQuery
     */
    public function getFunctionalities()
    {
        return $this
            ->hasMany(Functionality::className(), ['id' => 'functionality_id'])
            ->via('profileFunctionalities');
    }

    /**
     * Gets query for [[ProfileFunctionalities]].
     *
     * @return ActiveQuery|ProfileFunctionalityQuery
     */
    public function getProfileFunctionalities()
    {
        return $this->hasMany(ProfileFunctionality::className(), ['profile_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }

    public function __toString()
    {
        return $this->name;
    }
}
