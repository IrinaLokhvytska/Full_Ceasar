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

    public function getLocation()
    {
        $model = new Locations();
        $fullName = $model->findByPk(Yii::app()->user->location)->full_name;
        $output = ['id'=>Yii::app()->user->location, 'full_name'=>$fullName];

        $output = empty($output) ? [] : $output;
        
        return $output;
    }
}