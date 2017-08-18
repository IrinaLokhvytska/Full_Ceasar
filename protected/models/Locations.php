<?php

class Locations extends CActiveRecord
{
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
}
