<?php

class m170901_083320_create_students_table extends CDbMigration
{
    public function safeUp()
    {
        $tableSchema = Yii::app()->db->schema->getTable('students');
        if ($tableSchema === null) {
            $this->createTable('students', array(
                'id' => 'pk',
                'first_name' => 'varchar(45) NOT NULL',
                'last_name' => 'varchar(45) NOT NULL',
                'photo_url' => 'varchar(120) NOT NULL',
                'english_lvl' => 'integer NOT NULL',
                'group_id' => 'integer NOT NULL',
                'incoming_test' => 'integer NOT NULL',
                'entry_score' => 'integer NOT NULL',
                'approved_by' => 'integer NOT NULL',
            ), 'ENGINE=InnoDB CHARSET=utf8');
            $this->addForeignKey('fk_english_lvl', 'students', 'english_lvl', 'english_lvl', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('fk_group_id', 'students', 'group_id', 'groups', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('fk_approved_by', 'students', 'approved_by', 'experts', 'id', 'CASCADE', 'CASCADE');
        }
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_english_lvl', 'students');
        $this->dropForeignKey('fk_group_id', 'students');
        $this->dropForeignKey('fk_approved_by', 'students');
        $this->dropTable('students');
    }
}
