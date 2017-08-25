<?php


class LocationComponent extends CApplicationComponent
{
    public function getList()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'full_name';
        $locations = Locations::model()->findAll($criteria);

        return $locations;
    }
}