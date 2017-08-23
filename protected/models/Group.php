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
    protected function instantiate($attributes)
    {
        $class = get_class($this);
        $model = new $class(
            $attributes['id'],
            $attributes['name'],
            $attributes['location'],
            $attributes['direction'],
            $attributes['start_date'],
            $attributes['finish_date'],
            $attributes['budget']
        );
        return $model;
    }
    public static function getGroups()
    {
        return self::model()->findAll();
    }
    public function relations ()
    {
        return [
            'location' =>[self::HAS_ONE, 'Locations', 'id'],
            'direction' =>[self::HAS_ONE, 'Direction', 'id'],
            'teachers' => [self::MANY_MANY, 'Teachers', 'user_groups(group, user)'],
            'experts' => [self::MANY_MANY, 'Experts', 'group_experts(group, name)']
        ];
    }
}
