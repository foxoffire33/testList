<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160331_110341_createDB extends Migration
{


    public function safeUp()
    {
        $this->createTable('behandelaar', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'first_name' => $this->string(128),
            'last_name' => $this->string(128),
            'user_id' => $this->integer(11)
        ], $this->getDatetimeColumns()));


        $this->createTable('test', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128),
        ], $this->getDatetimeColumns()));

        $this->createTable('vraag', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'text' => $this->string(128),
            'test_id' => $this->integer(11),
        ], $this->getDatetimeColumns()));

        $this->createTable('andwoord', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'text' => $this->string(128),
            'vraag_id' => $this->integer(11)
        ], $this->getDatetimeColumns()));

        $this->createTable('client', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'first_name' => $this->string(128),
            'last_name' => $this->string(128),
            'email' => $this->string(128)
        ], $this->getDatetimeColumns()));

        $this->createTable('client_test', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'client_id' => $this->integer(11),
            'test_id' => $this->integer(11)
        ], $this->getDatetimeColumns()));

        $this->createTable('score', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'client_test_id' => $this->integer(11),
            'andwoord_id' => $this->integer(11)
        ], $this->getDatetimeColumns()));


        $this->addForeignKey('behandelar_user_id_fk', 'behandelaar', 'user_id', 'user', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('vraag_test_id', 'vraag', 'test_id', 'test', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('andwoord_vraag_id', 'andwoord', 'vraag_id', 'vraag', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('client_test_client_id_fk', 'client_test', 'client_id', 'client', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('client_test_test_id_fk', 'client_test', 'test_id', 'test', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('score_client_test_id_fk', 'score', 'client_test_id', 'client_test', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('score_client_andwoord_id_fk', 'score', 'andwoord_id', 'andwoord', 'id', 'CASCADE', 'NO ACTION');


    }

    private function getDatetimeColumns()
    {
        return [
            'created' => $this->dateTime(),
            'updated' => $this->dateTime()
        ];
    }

    public function safeDown()
    {
        $this->dropForeignKey('behandelar_user_id_fk', 'behandelaar');
        $this->dropForeignKey('vraag_test_id', 'vraag');
        $this->dropForeignKey('andwoord_vraag_id', 'andwoord');
        $this->dropForeignKey('client_test_client_id_fk', 'client_test');
        $this->dropForeignKey('client_test_test_id_fk', 'client_test');
        $this->dropForeignKey('score_client_test_id_fk', 'score');
        $this->dropForeignKey('score_client_andwoord_id_fk', 'score');

        $this->dropTable('behandelaar');
        $this->dropTable('test');
        $this->dropTable('vraag');
        $this->dropTable('andwoord');
        $this->dropTable('client');
        $this->dropTable('client_test');
        $this->dropTable('score');
    }

}
