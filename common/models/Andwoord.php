<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "andwoord".
 *
 * @property integer $id
 * @property string $text
 * @property integer $vraag_id
 * @property string $created
 * @property string $updated
 *
 * @property Vraag $vraag
 */
class Andwoord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'andwoord';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vraag_id','text'],'required'],
            [['vraag_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['text'], 'string', 'max' => 128],
            [['vraag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vraag::className(), 'targetAttribute' => ['vraag_id' => 'id']],
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
            'vraag_id' => 'Vraag ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVraag()
    {
        return $this->hasOne(Vraag::className(), ['id' => 'vraag_id']);
    }
}
