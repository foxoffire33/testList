<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $created
 * @property string $updated
 *
 * @property ClientTest[] $clientTests
 */
class Client extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name','last_name'],'required'],
            ['email','email'],
            [['first_name','last_name','email'],'unique'],
            [['created', 'updated'], 'safe'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 128],
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
            'email' => 'Email',
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientTests()
    {
        return $this->hasMany(ClientTest::className(), ['client_id' => 'id']);
    }

    public function getName(){
        return "{$this->first_name} {$this->last_name}";
    }

}
