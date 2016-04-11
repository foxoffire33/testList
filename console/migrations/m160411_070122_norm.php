<?php

use yii\db\Migration;

class m160411_070122_norm extends Migration
{
    public function safeUp()
    {
        $this->createTable('norm', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(128),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime()
        ]);

        $this->createTable('norm_category', [
            'id' => $this->primaryKey(11),
            'norm_id' => $this->integer(11),
            'category_id' => $this->integer(11),
            'score' => $this->float(),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime()
        ]);

        $this->addForeignKey('norm_category_norm_id_fk', 'norm_category', 'norm_id', 'norm', 'id', 'CASCADE', 'No ACTION');
        $this->addForeignKey('norm_category_category_id_fk', 'norm_category', 'category_id', 'category', 'id', 'CASCADE', 'NO ACTION');

        $this->createIndex('unique_combination', 'norm_category', ['norm_id', 'category_id'], true);

    }

    public function safeDown()
    {
        $this->dropForeignKey('norm_category_norm_id_fk', 'norm_category');
        $this->dropForeignKey('norm_category_category_id_fk', 'norm_category');

        $this->dropIndex('unique_combination', 'norm_category');

        $this->dropTable('norm');
        $this->dropTable('norm_category');

    }
}
