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
        $criteria->select = 'name';
        $locations = Locations::model()->findAll($criteria);

        return $locations;
    }

    public function getLocationsIdList($locations)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->addInCondition('name', $locations);
        $locationsIdArray = Locations::model()->findAll($criteria);

        return $locationsIdArray;
    }
}
