<?php

class GroupListComponent extends CApplicationComponent
{
    public function get()
    {
        $criteria = new CDbCriteria();
//        $criteria->alias = 'group';
//        $criteria->select = ["{$criteria->alias}.name"];
//        $criteria->join = "JOIN directions ON directions.id = {$criteria->alias}.direction";
//
//        /** @var Group[] $rows */
//        $rows = Group::model()->with('direction')->findAll($criteria);
//        $result = [];
//        if (empty($rows)) {
//            return $result;
//        }
//        foreach ($rows as $row) {
//            $result[] = [
//                'group_name' => $row->name,
//                'direction_name' => $row->direction->name
//            ];
//        }
        $result = Group::model()->findAll();

        return empty($result) ? [] : $result;
    }
}
