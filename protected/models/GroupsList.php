<?php

class GroupsList extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'groups';
    }

    public function getGroupsList()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'name, direction';
        $groupsList = GroupsList::model()->findAll($criteria);

        return $groupsList;
    }

}
