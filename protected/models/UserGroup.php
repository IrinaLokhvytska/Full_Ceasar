<?php

class UserGroup  extends CActiveRecord
{
    public $id;
    public $user;
    public $group;
    public $direction_id;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_groups';
    }

    public function relations ()
    {
        return [
            'group' =>[self::BELONGS_TO, 'Group', 'group'],
        ];
    }
}
