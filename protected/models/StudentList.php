<?php

class StudentList extends CActiveRecord
{
    public $id;
    public $first_name;
    public $last_name;
    public $photo_url;
    public $english_lvl;
    public $group_id;
    public $incoming_test;
    public $entry_score;
    public $approved_by;

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
        $criteria->select = 'first_name';
        $students = StudentList::model()->findAll($criteria);

        return $students;
    }

    public function relations ()
    {
        return [
            'english' =>[self::BELONGS_TO, 'English', 'english_lvl']
        ];
    }
}
