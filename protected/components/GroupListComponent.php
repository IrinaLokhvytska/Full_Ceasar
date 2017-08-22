<?php

class GroupListComponent extends CApplicationComponent
{
    public function get()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'group';
        $criteria->select = ['directions.*', "{$criteria->alias}.*"];
        $criteria->join = "JOIN directions ON directions.id = {$criteria->alias}.direction";
        $groupsList = Group::model()->with('direction')->findAll($criteria);
        return empty($groupsList) ? [] : $groupsList;
    }
}
