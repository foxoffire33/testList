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
            [['antwoord_id'], 'required'],//todo fixen dat ook client_test_id gezit moet zijn in de bedend
            [['client_test_id', 'antwoord_id'], 'integer'],
            [['created', 'updated', 'vraagID','antwoord_id'], 'safe'],
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
            'antwoord_id' => 'Antwoord ID',
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

    public function getAntwoord()
    {
        return $this->hasOne(Antwoord::className(), ['id' => 'antwoord_id']);
    }
}
