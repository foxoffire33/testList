<?php

use yii\db\Migration;

class m160407_095242_addPsycholoog extends Migration
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

        $this->delete('behandelaar');
        $this->delete('psycholoog');
    }

    public function safeDown()
    {
        $this->dropForeignKey('user_id_psycholoog_fk', 'psycholoog');
        $this->dropTable('psycholoog');
        $this->addColumn('user', 'isAdmin', 'bool');
    }
}
