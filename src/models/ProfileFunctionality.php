<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%profile_functionality}}".
 *
 * @property int $profile_id
 * @property int $functionality_id
 * @property int $created_at
 *
 * @property Functionality $functionality
 * @property Profile $profile
 */
class ProfileFunctionality extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile_functionality}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profile_id', 'functionality_id'], 'required'],
            [['profile_id', 'functionality_id', 'created_at'], 'integer'],
            [['profile_id', 'functionality_id'], 'unique', 'targetAttribute' => ['profile_id', 'functionality_id']],
            [['functionality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Functionality::className(), 'targetAttribute' => ['functionality_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'profile_id' => Yii::t('app', 'Profile'),
            'functionality_id' => Yii::t('app', 'Functionality'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Functionality]].
     *
     * @return \yii\db\ActiveQuery|FunctionalityQuery
     */
    public function getFunctionality()
    {
        return $this->hasOne(Functionality::className(), ['id' => 'functionality_id']);
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileFunctionalityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileFunctionalityQuery(get_called_class());
    }
}
