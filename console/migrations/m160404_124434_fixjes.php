<?php

use yii\db\Migration;

class m160404_124434_fixjes extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('score_client_andwoord_id_fk', 'score');
        $this->renameTable('andwoord', 'antwoord');
        $this->renameColumn('score', 'andwoord_id', 'antwoord_id');
        $this->addColumn('user', 'isAdmin', 'bool');
        $this->addForeignKey('score_client_antwoord_id_fk', 'score', 'antwoord_id', 'antwoord', 'id', 'CASCADE', 'NO ACTION');
    }

    public function safeDown()
    {
        $this->dropForeignKey('score_client_antwoord_id_fk', 'score');
        $this->dropColumn('user', 'isAdmin');
        $this->renameColumn('score', 'antwoord_id', 'andwoord_id');
        $this->renameTable('antwoord', 'andwoort');
        $this->renameTable('andwoort', 'andwoord');
        $this->addForeignKey('score_client_andwoord_id_fk', 'score', 'andwoord_id', 'andwoord', 'id', 'CASCADE', 'NO ACTION');
    }
}
