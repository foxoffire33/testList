<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "vraag".
 *
 * @property integer $id
 * @property string $text
 * @property integer $test_id
 * @property string $created
 * @property string $updated
 *
 * @property Andwoord[] $andwoords
 * @property Test $test
 */
class Vraag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vraag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['text'], 'string', 'max' => 128],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            //unique
            [['text', 'test_id'], 'unique', 'targetAttribute' => ['vraag_id', 'text']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'test_id' => 'Test ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAntwoorden()
    {
        return $this->hasMany(Antwoord::className(), ['vraag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
}
