<?php

class Schedule extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'group';
    }

    public function getSchedule()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'schedule';
        $schedule = Schedule::model()->findAll($criteria);

        return $schedule;
    }
}
