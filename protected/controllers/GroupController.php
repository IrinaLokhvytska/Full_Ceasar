<?php

class GroupController extends BaseController
{
    public function actionCreate()
    {
<<<<<<< HEAD

        $requestBody = file_get_contents('php://input');

        if (empty($requestBody)) {
            throw new CHttpException(400, 'Invalid data');
        }
        $data = json_decode($requestBody, true);

        $group = new Group();
        $group->setAttribute('name', $data['name']);
        $group->setAttribute('location_id', $data['location_id']);
        $group->setAttribute('direction_id', $data['direction_id']);
        $group->setAttribute('start_date', $data['start_date']);
        $group->setAttribute('finish_date', $data['finish_date']);
        $group->setAttribute('budget', $data['budget']);

        if(!$group->validate()){
            throw new CHttpException(400, 'Invalid data');
        }
        $group->save();
        $groupId = $group->id;

        $groupTeachers = $data['teachers'];
        foreach ($groupTeachers as $key=>$value){
            $teacher = new Teacher();
            $teacher->setAttribute('group', $groupId);
            $teacher->setAttribute('user', $value);
            $teacher->save();
        }

        $experts = $data['experts'];
        if(!empty($experts)){
            foreach ($experts as $person){
                $expert = new Expert();
                $expert->group = $groupId;
                $expert->name = $person;
                $expert->save();
            }
        }

       $this->renderJson(["success" => true]);
=======
        $component = Yii::app()->getComponent('Group');
        $component->createGroup();
        $this->renderJson(["success" => true]);
>>>>>>> bb91a505d3386552cc98859260ba2c805fe9bd21
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
