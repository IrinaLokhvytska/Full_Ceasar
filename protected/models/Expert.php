<?php
class Expert extends CActiveRecord
{
    public $id;
    public $name;
    public $group;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'group_experts';
    }
   
}
