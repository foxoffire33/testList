<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160404_124748_testData extends Migration
{
    public function up()
    {
        //create users
        $this->insert('user', [
            'username' => 'admin',
            'email' => 'reinier@releaz.nl',
            'password_hash' => Yii::$app->security->generatePasswordHash('asdasd'),
            'status' => 10,
            'isAdmin' => true,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('user', [
            'username' => 'behandelaar',
            'email' => 'test@releaz.nl',
            'password_hash' => Yii::$app->security->generatePasswordHash('asdasd'),
            'status' => 10,
            'isAdmin' => false,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        //create list
        $this->insert('test', ArrayHelper::merge([
            'name' => 'list 1',
        ],$this->getCreatedAndUpdated()));

        $test = \common\models\Test::findOne(['name' => 'list 1']);

        $this->insert('vraag', ArrayHelper::merge([
            'taxt' => 'lijkt blij met bezoek van familieleden',
            'vraag_id' => $test->id,
        ],$this->getCreatedAndUpdated()));


    }

    public function down()
    {
        $this->delete('user');
    }

    private function getCreatedAndUpdated()
    {
        $date = date('Y-m-d H:i:s');
        return ['created' => $date, 'updated' => $date];
    }
}
