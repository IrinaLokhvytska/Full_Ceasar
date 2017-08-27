<?php

class GroupController extends BaseController
{
    public function actionCreate()
    {
        $requestBody = file_get_contents('php://input');

        if (empty($requestBody)) {
            throw new CHttpException(400, 'Invalid data');
        }
        $data = json_decode($requestBody, true);

        $group = new Group();
//        $group->setAttributes($data);
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
    }

    public function actionDelete($id)
    {
        //$groupId = file_get_contents('php://input');
        $groupId = $id;

        if (!$groupId) {
            throw new CHttpException(400, 'Invalid data');
        }

        $group = new Group();
        $group->findByPk($groupId)->delete();

        $this->renderJson(["success" => true]);
    }

    public function actionGetTeachersList()
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
        $id = file_get_contents('php://input');
        $model = new Group();
        $group = $model->findAllByPk($id);

        $this->renderJson($group);
    }

    public function actionEdit()
    {
        $requestBody = file_get_contents('php://input');

        if (empty($requestBody)) {
            throw new CHttpException(400, 'Invalid data');
        }
        $data = json_decode($requestBody, true);

        $idGroup = $data['id'];
        $model = new Group();
        $group = $model->findByPk($idGroup);

        $group->setAttribute('name', $data['name']);
        $group->setAttribute('location_id', $data['location_id']);
        $group->setAttribute('direction_id', $data['direction_id']);
        $group->setAttribute('start_date', $data['start_date']);
        $group->setAttribute('finish_date', $data['finish_date']);
        $group->setAttribute('budget', $data['budget']);

        if(!$group->validate()){
            throw new CHttpException(400, 'Invalid data');
        }
        $group->update();

//        $groupTeachers = $data['teachers'];
//        foreach ($groupTeachers as $value){
//            $modelTeacher = new Teacher();
//            $teacher = $modelTeacher->findAllByAttributes('group', $idGroup);
//            $teacher->setAttribute('user', $value);
//            $teacher->update();
//        }
//
//        $experts = $data['experts'];
//        if(!empty($experts)){
//            foreach ($experts as $person){
//                $modelExpert = new Expert();
//                $expert = $modelExpert->findAllByAttributes('group', $idGroup);
//                $expert->name = $person;
//                $expert->update();
//            }
//        }

        $this->renderJson(["success" => true]);
    }
}
