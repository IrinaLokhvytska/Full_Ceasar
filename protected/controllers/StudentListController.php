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
        $students = $component->getStudentList($id);
        $this->renderJson($students);
    }
}
