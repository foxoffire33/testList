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
class Antwoord extends ActiveRecord
{
    public $vraag_id_virtual;
    public $total;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'antwoord';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vraag_id', 'text','waarde'], 'required'],
            [['vraag_id','waarde'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['text'], 'string', 'max' => 128],
            //exists
            ['vraag_id_virtual', 'exist', 'targetClass' => Vraag::className(), 'targetAttribute' => ['vraag_id_virtual' => 'text']],
            //unique
            [['vraag_id', 'text'], 'unique', 'targetAttribute' => ['vraag_id', 'text']]
        ];
    }

    public function afterValidate()
    {
        if (!empty($this->vraag_id_virtual)) {
            $this->vraag_id = Vraag::findOne(['text' => $this->vraag_id_virtual])->id;
        }
        parent::afterValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'vraag_id' => 'Vraag',
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
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
