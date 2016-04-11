<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "behandelaar".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 */
class Behandelaar extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'behandelaar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Voornaam',
            'last_name' => 'Naam',
            'user_id' => 'Gebruiker',
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getName(){
        return "{$this->first_name} {$this->last_name}";
    }
}
