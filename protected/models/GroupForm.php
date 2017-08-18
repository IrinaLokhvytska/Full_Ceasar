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
            ['$direction', 'allowEmpty' => false, 'required'],
            ['$direction', 'allowEmpty' => false, 'required'],
            ['$direction', 'allowEmpty' => false, 'required'],
            ['budgetOwner', 'required'],
            ['startDate', 'type', 'type' => 'date', 'dateFormat' => 'dd.MM.yyyy', 'allowEmpty' => false],
            ['startDate', 'type', 'type' => 'date', 'dateFormat' => 'dd.MM.yyyy', 'allowEmpty' => false],
            ['expert', 'type', 'type' => 'string', 'allowEmpty' => false, 'length', 'min' => 3, 'max' => 30]
        ];
    }
}
