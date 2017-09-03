<?php

class StudentComponent extends CApplicationComponent
{
   public function getStudentList($id)
   {
       $criteria = new CDbCriteria();
       $criteria->alias = 'students';
       $criteria->condition = "$id = {$criteria->alias}.group_id";
       return StudentList::model()->findAll($criteria);
   }
}
