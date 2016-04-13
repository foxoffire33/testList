<?php

use yii\db\Migration;

class m160412_081647_changeNorm extends Migration
{
    public function safeUp()
    {
        if (in_array('score', $this->getModelColumns())) {
            $this->renameColumn('norm_category', 'score', 'max');
        }
        if (!in_array('formule', $this->getModelColumns())) {
            $this->addColumn('norm_category', 'formule', 'text');
        }

        if (!in_array('default', $this->getModelColumns())) {
            $this->addColumn('norm_category', 'default', 'int(2)');
        }
    }

    private function getModelColumns()
    {
        $model = new \common\models\NormCategory();
        return $model->getTableSchema()->getColumnNames();
    }

    public function safeDown()
    {
        if (in_array('max', $this->getModelColumns())) {
            $this->renameColumn('norm_category', 'max', 'score');
        }

        if (in_array('formule', $this->getModelColumns())) {
            $this->dropColumn('norm_category', 'formule');
        }
        if (in_array('default', $this->getModelColumns())) {
            $this->dropColumn('norm_category', 'default');
        }
    }

}
