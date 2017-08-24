<?php
class Group extends CActiveRecord
{
    public $id;
    public $name;
    public $location;
    public $direction;
    public $start_date;
    public $finish_date;
    public $budget;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'groups';
    }

    public function relations ()
    {
        return [
            'location' =>[self::BELONGS_TO, 'Locations', 'location'],
            'direction' =>[self::BELONGS_TO, 'Direction', 'direction'],
            'teachers' => [self::MANY_MANY, 'Teachers', 'user_groups(group, user)'],
            'experts' => [self::MANY_MANY, 'Experts', 'group_experts(group, name)']
        ];
    }
}
