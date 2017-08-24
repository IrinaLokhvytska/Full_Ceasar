<?php

class Locations extends CActiveRecord
{
    public $id;
    public $short_name;
    public $full_name;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'locations';
    }

    public function getLocations()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'full_name';
        $locations = self::model()->findAll($criteria);

        return $locations;
    }
}
