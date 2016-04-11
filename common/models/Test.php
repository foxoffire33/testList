<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $name
 * @property string $created
 * @property string $updated
 *
 * @property ClientTest[] $clientTests
 * @property Vraag[] $vraags
 */
class Test extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientTests()
    {
        return $this->hasMany(ClientTest::className(), ['test_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['test_id' => 'id']);
    }

}
