<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "norm_category".
 *
 * @property integer $id
 * @property integer $norm_id
 * @property integer $category_id
 * @property double $score
 * @property string $created
 * @property string $updated
 *
 * @property Category $category
 * @property Norm $norm
 */
class NormCategory extends \common\components\db\ActiveRecord
{
    public $norm_id_virtual;
    public $norm_category_id_virtual;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'norm_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['norm_id_virtual', 'norm_category_id_virtual', 'score'], 'required'],
            [['score'], 'number'],
            [['created', 'updated', 'norm_category_id_virtual'], 'safe'],
            [['norm_category_id_virtual'], 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'name'],
            [['norm_id_virtual'], 'exist', 'targetClass' => Norm::className(), 'targetAttribute' => 'name'],
        ];
    }

    public function beforeSave($insert)
    {
        $this->norm_id = Norm::findOne(['name' => $this->norm_id_virtual])->id;
        $this->category_id = Category::findOne(['name' => $this->norm_category_id_virtual])->id;

        if (!empty(self::findOne(['norm_id' => $this->norm_id, 'category_id' => $this->category_id]))) {
            $this->addError('norm_id_virtual', 'Deze norm zit al aan deze category gekopeld');
            return false;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'norm_id' => 'Norm ID',
            'category_id' => 'Category ID',
            'score' => 'Score',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNorm()
    {
        return $this->hasOne(Norm::className(), ['id' => 'norm_id']);
    }
}
