<?php

use yii\db\Migration;

class m160407_113339_vraagenAndAwnserFixjes extends Migration
{

    public function safeUp()
    {
        $this->alterColumn('vraag', 'text', 'blob');
        $this->alterColumn('antwoord', 'text', 'blob');
    }

    public function safeDown()
    {
        $this->alterColumn('vraag', 'text', 'string(128)');
        $this->alterColumn('antwoord', 'text', 'string(128)');
    }
}
