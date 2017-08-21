<?php

class User extends CActiveRecord
{
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $location;
    public $type;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }

    protected function instantiate($attributes)
    {
        $class = get_class($this);
        $model = new $class(
            $attributes['id'],
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['username'],
            $attributes['password'],
            $attributes['location'],
            $attributes['type']
        );

        return $model;
    }

    public static function getUsers()
    {
        return self::model()->findAll();
    }

    public function relations ()
    {
        return [
            'location' =>[self::HAS_ONE, 'Locations', 'id'],
            'role' => [self::HAS_MANY, 'User', 'user']
        ];
    }


}
