<?php
class Teacher extends CActiveRecord
{
    public $id;
    public $user;
    public $group;
    
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
            'group' => [self::MANY_MANY, 'Group', 'group_experts(group, name)']
        ];
    }
   
}
