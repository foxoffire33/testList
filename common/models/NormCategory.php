<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "norm_category".
 *
 * @property integer $id
 * @property integer $norm_id
 * @property integer $category_id
 * @property double $max
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

    public $formulles;
    public $formulleOptions = ['>' => '>', '<' => '<', '==' => '=='];

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
            [['norm_id_virtual', 'norm_category_id_virtual', 'max', 'default'], 'required'],
            [['max', 'default'], 'number'],
            [['created', 'updated', 'norm_category_id_virtual', 'formule', 'formulles'], 'safe'],
            [['norm_category_id_virtual'], 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'name'],
            [['norm_id_virtual'], 'exist', 'targetClass' => Norm::className(), 'targetAttribute' => 'name'],
        ];
    }

    public function beforeSave($insert)
    {
        $this->norm_id = Norm::findOne(['name' => $this->norm_id_virtual])->id;
        $this->category_id = Category::findOne(['name' => $this->norm_category_id_virtual])->id;
        if ($this->isNewRecord) {
            if (!empty(self::findOne(['norm_id' => $this->norm_id, 'category_id' => $this->category_id]))) {
                $this->addError('norm_id_virtual', 'Deze norm zit al aan deze category gekopeld');
                return false;
            }
        }

        $this->formule = json_encode($this->formulles);
        return parent::beforeSave($insert);
    }

    public function beforeValidate()
    {
        if (!empty($this->formulles)) {
            $this->formulles = array_values($this->formulles);
            $this->formulles = json_decode(json_encode($this->formulles));
            foreach ($this->formulles as $key => $formulle) {
                if (!in_array($formulle->option, $this->formulleOptions) || !$this->numberCheck($formulle->value) || !$this->numberCheck($formulle->true)) {
                    $this->addError('max', 'formulles klopen niet');
                }
            }
        }
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'norm_id' => 'Norm',
            'category_id' => 'Categorie',
            'max' => 'Max',
            'created' => 'Aangemaakt op',
            'updated' => 'Bewerkt op',
        ];
    }

    public function getFormuleResult($id)
    {
        $this->category->setClientTestId($id);
        if ($this->EvalFormulle !== false) {
            $result = eval('return ' . str_replace('{score}', $this->category->categoryTotalScore, $this->EvalFormulle) . ';');
            return (floatval($result) > floatval($this->max) ? $this->max : $result);
        }
        return 0;
    }

    public function getEvalFormulle()
    {
        if (!empty($this->formule)) {
            $jsonToPhpArray = json_decode($this->formule);
            $stringTest = '';
            for ($i = 0; $i < count($jsonToPhpArray); $i++) {
                $stringTest .= "({score} {$jsonToPhpArray[$i]->option} {$jsonToPhpArray[$i]->value} ? {$jsonToPhpArray[$i]->true} : ";
            }
            $stringTest .= $this->default;
            $stringTest .= str_repeat(')', count($jsonToPhpArray));

            return $stringTest;
        }
        return false;
    }

    public function afterFind()
    {
        if (!empty($this->formule)) {
            $this->formulles = json_decode($this->formule);
        }
        return parent::afterFind();
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

    private function numberCheck($string)
    {
        return preg_match('/^[0-9]+$/', $string);
    }
}
