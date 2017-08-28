<?php


class TeacherComponent extends CApplicationComponent
{
    public function getTeachersList()
    {
        $location_id = Yii::app()->user->location;
        $teachers = Yii::app()->db->createCommand()
            ->select('first_name, last_name, u.id')
            ->from('user_roles ur')
            ->join('users u', 'u.id=ur.id')
            ->where('role=1 AND location_id = :location_id', [':location_id'=>$location_id])
            ->queryAll();

        $teachers = empty($teachers) ? [] : $teachers;
        
        return $teachers;
    }

    public function getAllTeachersList()
    {
        $teachers = Yii::app()->db->createCommand()
            ->select('first_name, last_name, u.id')
            ->from('user_roles ur')
            ->join('users u', 'u.id=ur.id')
            ->where('role=1')
            ->queryAll();

        $teachers = empty($teachers) ? [] : $teachers;

       return $teachers;
    }

}