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
            [['category_id', 'text'], 'required'],
            [['category_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['text'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
            //unique
            [['text', 'category_id'], 'unique', 'targetAttribute' => ['text']]
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
            'category_id' => 'Categorie',
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

}
