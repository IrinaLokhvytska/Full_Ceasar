<?php

class StudentListController extends BaseController
{
    public function actionGetStudentList()
    {
        $students = StudentList::model()->getStudentList();
        $this->renderJSON($students);
    }
}
