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
    public $cv_url;

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
            'english_lvl' =>[self::BELONGS_TO, 'EnglishLevel', 'english_lvl'],
            'group' => [self::BELONGS_TO, 'Group', 'group_id'],
            'expert' => [self::BELONGS_TO, 'Expert', 'approved_by'],
        ];
    }

    public function rules()
    {
        return [
            ['first_name, last_name, photo_url, cv_url, english_lvl, group_id', 'incoming_test', 'entry_score', 'required'],
            ['first_name', 'length', 'min' => 2, 'max'=>20],
            ['last_name', 'length', 'min' => 2, 'max'=>20]
        ];
    }
}