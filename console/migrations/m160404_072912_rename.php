<?php

use yii\db\Migration;

class m160404_072912_rename extends Migration
{
    public function up()
    {
        $this->renameTable('andwoord','andwoort');
    }

    public function down()
    {
        $this->renameTable('andwoort','andwoord');
    }
}
