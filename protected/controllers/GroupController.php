<?php

class GroupController extends BaseController
{
    public function actionCreate()
    {
        $component = Yii::app()->getComponent('Group');
        $component->createGroup();
        $this->renderJson(["success" => true]);
    }

    public function actionDelete($id)
    {
        $component = Yii::app()->getComponent('Group');
        $component->deleteGroup($id);
        $this->renderJson(["success" => true]);
    }

    public function actionEdit()
    {
        $component = Yii::app()->getComponent('Group');
        $component->editGroup();
        $this->renderJson(["success" => true]);
    }

    public function actionGetTeachersList()
    {
        $location_id = Yii::app()->user->location;
        $teachers = Yii::app()->db->createCommand()
            ->select('first_name, last_name, u.id')
            ->from('user_roles ur')
            ->join('users u', 'u.id=ur.id')
            ->where('role=1 AND location_id = :location_id', [':location_id'=>$location_id])
            ->queryAll();

        $teachers = empty($teachers) ? [] : $teachers;

        $this->renderJson($teachers);
    }

    public function actionGetAllTeachersList()
    {
        $teachers = Yii::app()->db->createCommand()
            ->select('first_name, last_name, u.id')
            ->from('user_roles ur')
            ->join('users u', 'u.id=ur.id')
            ->where('role=1')
            ->queryAll();

        $teachers = empty($teachers) ? [] : $teachers;

        $this->renderJson($teachers);
    }

    public function actionGetLocation()
    {
        $model = new Locations();
        $fullName = $model->findByPk(Yii::app()->user->location)->full_name;
        $output = ['id'=>Yii::app()->user->location, 'full_name'=>$fullName];

        $output = empty($output) ? [] : $output;
        $this->renderJson($output);
    }

    public function actionGetDirectionsList()
    {
        $model = new Direction();
        $directions = $model->findAll();
        $directions = empty($directions) ? [] : $directions;

        $this->renderJson($directions);
    }

    public function actionGetGroupInformation()
    {
        //$id = file_get_contents('php://input');
        $id = 23;
        $model = new Group();
        $group = $model->findByPk($id);
        $teachers = $group->getRelated('teachers');

        $this->renderJson($teachers);
    }


}
