<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160406_114945_addCategoriesToQuestionsAndValueToAwnser extends Migration
{
    public function safeUp()
    {
        $this->createTable('category', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128)->notNull(),
            'test_id' => $this->integer(11)
        ], $this->getDatetimeColumns()));

        $this->addForeignKey('test_id_category_fk', 'category', 'test_id', 'test', 'id', 'CASCADE', 'NO ACTION');

        $this->addColumn('vraag', 'category_id', 'integer(11)');
        $this->addForeignKey('vraag_categoy_id_fk', 'vraag', 'category_id', 'category', 'id', 'CASCADE', 'NO ACTION');

        $this->dropForeignKey('vraag_test_id', 'vraag');

        $this->addColumn('antwoord','waarde','smallint');

        $this->delete('vraag');

    }

    private function getDatetimeColumns()
    {
        return [
            'created' => $this->dateTime(),
            'updated' => $this->dateTime()
        ];
    }

    public function getInsetDatetime()
    {
        $date = date('Y-m-d H:i:s');
        return [
            'created' => $date,
            'updated' => $date
        ];
    }

    public function safeDown()
    {
        $this->dropForeignKey('vraag_categoy_id_fk', 'vraag');
        $this->dropColumn('vraag', 'category_id');

        $this->dropForeignKey('test_id_category_fk', 'category');
        $this->dropTable('category');

        $this->addForeignKey('vraag_test_id', 'vraag', 'test_id', 'test', 'id', 'CASCADE', 'NO ACTION');

        $this->dropColumn('antwoord','waarde');
    }
}
