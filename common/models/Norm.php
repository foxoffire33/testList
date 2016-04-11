<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "norm".
 *
 * @property integer $id
 * @property string $name
 * @property string $created
 * @property string $updated
 *
 * @property NormCategory[] $normCategories
 */
class Norm extends \common\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'norm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => '128'],
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
            'name' => 'Name',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNormCategories()
    {
        return $this->hasMany(NormCategory::className(), ['norm_id' => 'id']);
    }
}
