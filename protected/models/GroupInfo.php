<?php

class GroupInfo extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'group';
    }

    public function getGroupInfo()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'name, date_start, date_end, direction_id';
        $groupInfo = GroupInfo::model()->findAll($criteria);

        return $groupInfo;
    }
}
