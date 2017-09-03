<?php

class StudentListController extends BaseController
{
    public function actionGetStudentList()
    {
        $students = StudentList::model()->getStudentList();
        $this->renderJSON($students);
    }
    
    public function actionGetStudentsFromGroup($id)
    {
        $component = Yii::app()->getComponent('Student');
        $teachers = $component->getStudentList($id);
        $this->renderJson($teachers);
    }
}
