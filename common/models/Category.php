<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $created
 * @property string $updated
 *
 * @property Vraag[] $vraags
 */
class Category extends \common\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'test_id'], 'required'],
            ['test_id', 'integer'],
            ['test_id', 'exist', 'targetClass' => Test::className(), 'targetAttribute' => 'id'],
            [['name', 'test_id'], 'unique', 'targetAttribute' => ['name', 'test_id']],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Naam',
            'test_id' => 'Test',
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
        ];
    }

    /**
     * get all scores and count all antwoord.waarde columns
     * @return float
     */
    public function getCategoryScore()
    {
        $scores = $this->scores;
        return round(array_sum(ArrayHelper::getColumn($scores, 'antwoord.waarde')) / count($scores), 2);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVragen()
    {
        return $this->hasMany(Vraag::className(), ['category_id' => 'id']);
    }

    public function gettest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    public function getScores()
    {
        return $this->hasMany(Score::className(), ['client_test_id' => 'test_id'])
            ->joinWith(['antwoord.vraag'])->where(['vraag.category_id' => $this->id]);
    }

}
