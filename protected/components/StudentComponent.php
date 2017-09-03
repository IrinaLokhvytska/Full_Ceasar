<?php

class StudentComponent extends CApplicationComponent
{
   public function getStudentList($id)
   {
       $criteria = new CDbCriteria();
       $criteria->alias = 'students';
       $criteria->condition = "$id = {$criteria->alias}.group_id";
       $rows = StudentList::model()->with('english_lvl')->findAll($criteria);
       $result = [];
       if (empty($rows)) {
           return $result;
       }
       foreach ($rows as $row) {
           $result[] = [
               'id' => $row->id,
               'first_name' => $row->first_name,
               'last_name' => $row->last_name,
               'photo_url' => $row->photo_url,
               'english_lvl' => $row->getRelated('english')->name,
               'incoming_test' => $row->incoming_test,
               'entry_score' => $row->entry_score,
               'approved_by' => $row->approved_by,
           ];
       }

       return $result;
   }
}
