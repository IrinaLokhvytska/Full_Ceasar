<?php

class m170901_104716_create_feedbacks_table extends CDbMigration
{
    public function safeUp()
    {
        $tableSchema = Yii::app()->db->schema->getTable('feedbacks');
        if ($tableSchema === null) {
            $this->createTable('feedbacks', array(
                'id' => 'pk',
                'student_id' => 'integer NOT NULL',
                'teacher_score' => 'integer NOT NULL',
                'teacher_summery' => 'varchar(250) NOT NULL',
                'expert_score' => 'integer NOT NULL',
                'expert_summery' => 'varchar(250) NOT NULL',
                'interviewer_score' => 'integer NOT NULL',
                'interviewer_summery' => 'varchar(250) NOT NULL',
            ), 'ENGINE=InnoDB CHARSET=utf8');
            $this->addForeignKey('fk_student_id', 'feedbacks', 'student_id', 'students', 'id', 'CASCADE', 'CASCADE');
        }
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_student_id', 'feedbacks');
        $this->dropTable('feedbacks');
    }
}
