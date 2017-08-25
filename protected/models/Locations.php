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
}

