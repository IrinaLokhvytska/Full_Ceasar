<?php

class m170901_082020_create_english_lvl_table extends CDbMigration
{
    public function safeUp()
    {
        $tableSchema = Yii::app()->db->schema->getTable('english_lvl');
        if ($tableSchema === null) {
            $this->createTable('english_lvl', [
                'id' => 'pk',
                'name' => 'varchar(45) NOT NULL',
            ],
                'ENGINE=InnoDB CHARSET=utf8');
        }
        $this->insertMultiple('english_lvl', [
            ['id' => 1, 'name' => 'elementary'],
            ['id' => 2, 'name' => 'pre-intermediate'],
            ['id' => 3, 'name' => 'intermediate'],
            ['id' => 4, 'name' => 'upper- intermediate'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('english_lvl');
    }
}
