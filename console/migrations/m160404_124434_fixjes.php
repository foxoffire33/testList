<?php

use yii\db\Migration;

class m160404_124434_fixjes extends Migration
{
    public function up()
    {
        $this->renameTable('andwoort', 'antwoord');
        $this->addColumn('user', 'isAdmin', 'bool');
    }

    public function down()
    {
        $this->renameTable('antwoord', 'andwoort');
        $this->dropColumn('user', 'isAdmin');
    }
}
