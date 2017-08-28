<?php
class Group extends CActiveRecord
{
    public $id;
    public $name;
    public $location_id;
    public $direction_id;
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
            'location' =>[self::BELONGS_TO, 'Locations', 'location_id'],
            'direction' =>[self::BELONGS_TO, 'Direction', 'direction_id'],
            'teachers' => [self::MANY_MANY, 'Teacher', 'user_groups(group, user)']
//            'experts' => [self::MANY_MANY, 'Expert', 'group_experts(group, name)']
        ];
    }

    public function rules()
    {
        return [
            ['name, direction_id, location_id, start_date, budget, finish_date', 'required'],
            ['name', 'length', 'min' => 4, 'max'=>20]
//            ['start_date', 'type', 'type'=>'date', 'dateFormat' => 'dd.MM.yyyy'],
//            ['finish_date', 'type', 'type'=>'date', 'dateFormat' => 'dd.MM.yyyy']
        ];
    }
}
