<?php

class StudentList extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'students';
    }

    public function getStudentList()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'name';
        $students = StudentList::model()->findAll($criteria);

        return $students;
    }
}
