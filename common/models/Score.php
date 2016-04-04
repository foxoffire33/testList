<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "score".
 *
 * @property integer $id
 * @property integer $client_test_id
 * @property integer $andwoord_id
 * @property string $created
 * @property string $updated
 *
 * @property ClientTest $clientTest
 */
class Score extends ActiveRecord
{
    public $vraagID;
    public $vraag;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['andwoord_id'], 'required'],
            [['client_test_id', 'andwoord_id'], 'integer'],
            [['created', 'updated', 'vraagID','andwoord_id'], 'safe'],
            [['client_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientTest::className(), 'targetAttribute' => ['client_test_id' => 'id']],
        ];
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_test_id' => 'Client Test ID',
            'andwoord_id' => 'Andwoord ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientTest()
    {
        return $this->hasOne(ClientTest::className(), ['id' => 'client_test_id']);
    }

    public function getAndwoord()
    {
        return $this->hasOne(Andwoord::className(), ['id' => 'andwoord_id']);
    }
}
