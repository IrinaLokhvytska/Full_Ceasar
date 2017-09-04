<?php

/**
 * The followings are the available columns in table '{{students}':
 * @var integer $id
 * @var string $first_name
 * @var string $last_name
 * @var string $photo_url
 * @var integer $english_lvl
 * @var integer $group_id
 * @var integer $incoming_test
 * @var integer $entry_score
 * @var integer $aproved_by
 */

class Student extends CActiveRecord
{
    public $id;
    public $first_name;
    public $last_name;
    public $photo_url;
    public $english_lvl;
    public $group_id;
    public $incoming_test;
    public $entry_score;
    public $approved_by;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'students';
    }

    public function relations ()
    {
        return [
            'english' =>[self::BELONGS_TO, 'English', 'english_lvl']
        ];
    }

    public function rules()
    {
        return [
            ['name, direction_id, location_id, start_date, budget, finish_date', 'required'],
            ['name', 'length', 'min' => 4, 'max'=>20]
        ];
    }
}