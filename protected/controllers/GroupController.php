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
        $component = Yii::app()->getComponent('Teacher');
        $teachers = $component->getTeachersList();
        $this->renderJson($teachers);
    }
    public function actionGetAllTeachersList()
    {
        $component = Yii::app()->getComponent('Teacher');
        $teachers = $component->getAllTeachersList();
        $this->renderJson($teachers);
    }
    public function actionGetLocation()
    {
        $component = Yii::app()->getComponent('Location');
        $output = $component->getLocation();
        $this->renderJson($output);
    }
    public function actionGetDirectionsList()
    {
        $component = Yii::app()->getComponent('Direction');
        $directions = $component->getDirectionsList();
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