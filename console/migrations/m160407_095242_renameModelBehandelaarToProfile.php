<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160407_095242_renameModelBehandelaarToProfile extends Migration
{

    public function safeUp()
    {
        $this->createTable('psycholoog', [
            'id' => $this->primaryKey(11),
            'first_name' => $this->string(128)->notNull(),
            'last_name' => $this->string(128)->notNull(),
            'user_id' => $this->integer(11),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime()
        ]);

        $this->addForeignKey('user_id_psycholoog_fk', 'psycholoog', 'user_id', 'user', 'id', 'CASCADE', 'NO ACTION');
        $this->dropColumn('user', 'isAdmin');

    }

    public function safeDown()
    {
        $this->dropForeignKey('user_id_psycholoog_fk', 'psycholoog');
        $this->dropTable('psycholoog');
        $this->addColumn('user', 'isAdmin', 'bool');
    }
}
