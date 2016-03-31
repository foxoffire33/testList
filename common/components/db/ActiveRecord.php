<?php
namespace common\components\db;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        if ($this->hasAttribute('created') && $this->hasAttribute('updated')) {
            $date = date('Y-m-d H:i:s');
            if ($this->isNewRecord) {
                $this->created = $date;
            }
            $this->updated = $date;
        }
        return parent::beforeSave($insert);
    }
}