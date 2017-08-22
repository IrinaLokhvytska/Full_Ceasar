<?php

class GroupForm extends CFormModel
{
    public $id;

    public $groupName;
    public $direction;
    public $location;
    public $teachers;
    public $budgetOwner;
    public $startDate;
    public $finishDate;
    public $expert;

    public function rules()
    {
        return [
            ['id', 'unsafe', 'on' => 'edit'],
            ['groupName', 'type', 'type' => 'string', 'allowEmpty' => false, 'length', 'min' => 3, 'max' => 30],
            ['directionID', 'allowEmpty' => false, 'required'],
            ['locationID', 'allowEmpty' => false, 'required'],
            ['budgetOwner', 'required'],
            ['startDate', 'type', 'type' => 'date', 'dateFormat' => 'dd.MM.yyyy', 'allowEmpty' => false],
            ['finishDate', 'type', 'type' => 'date', 'dateFormat' => 'dd.MM.yyyy', 'allowEmpty' => false],
            ['teacherID', 'allowEmpty' => false, 'required'],
            ['expertName', 'type', 'type' => 'string', 'allowEmpty' => false, 'length', 'min' => 3, 'max' => 30],
        ];
    }
}
