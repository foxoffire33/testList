<?php

use yii\db\Migration;

class m160412_081647_changeNorm extends Migration
{
    public function safeUp()
    {
        $this->renameColumn('norm_category', 'score', 'max');
        $this->addColumn('norm_category', 'formule', 'blob');
    }

    public function safeDown()
    {
        $this->renameColumn('norm_category', 'max', 'score');
        $this->dropColumn('norm_category', 'formule');
    }
}
