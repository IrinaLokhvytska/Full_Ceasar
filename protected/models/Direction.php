<?php

class Direction extends CActiveRecord
{
    public $id;
    public $name;
    public $stream;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'directions';
    }

}
