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
        $group->setAttribute('name', $data['name']);
        $group->setAttribute('direction_id', $data['direction']);
        $group->setAttribute('location_id', $data['location']);
        $group->setAttribute('budget', $data['budgetOwner']);
        $group->setAttribute('start_date', $data['startDate']);
        $group->setAttribute('finish_date', $data['finishDate']);

        if(!$group->validate()){
            throw new CHttpException(400, 'Invalid data');
        }

        $group->save();
        $groupId = $group->id;

        $groupTeachers = $data['teachers'];
        foreach ($groupTeachers as $person){
            $teacher = new Teacher();
            $teacher->group = $groupId ;
            $teacher->user = $person;
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

    public function actionDelete()
    {
        $id = file_get_contents('php://input');
        if (empty($id)) {
            throw new CHttpException(400, 'Invalid data');
        }
        
        $model = new Group();
        $group = $model->findByPk($id);
        $group->delete();

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

    public function actionGetGroup()
    {
        $teachers = Yii::app()->db->createCommand()
            ->select('first_name, last_name')
            ->from('user_groups ug')
            ->join('users u', 'ug.id = u.id')
            ->where('ug.id=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();

//        $experts = Yii::app()->db->createCommand()
//            ->select('name')
//            ->from('group_experts')
//            ->where('id=:id', [':id' => Yii::app()->request->getParam('id')])
//            ->queryAll();

        $group = Yii::app()->db->createCommand()
            ->select('g.id, l.full_name, d.name, start_date, finish_date, budget, expert')

            ->from('groups g')
            ->join('directions d', 'g.direction_id=d.id')
            ->join('locations l', 'g.location_id=l.id')
            ->where('g.id=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();

        $groupName = Yii::app()->db->createCommand()
            ->select('name')
            ->from('groups')
            ->where('id=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();

        $group[] = $groupName;

        $group = empty($group) ? [] : $group;

        $teachers = empty($teachers) ? [] : $teachers;
        //$experts = empty($experts) ? [] : $experts;

        $group[] = $teachers;
        //$groups[] = $experts;

        $this->renderJson($group);

    }

    public function actionEdit()
    {
        $editFormAttributes = Yii::app()->request->getPost('EditForm', []);

        if (empty($editFormAttributes)) {
            throw new CHttpException(400, 'Invalid data');
        }

        $editedGroup = new GroupForm();
        $editedGroup->scenario = 'edit';
        $editedGroup->attributes = $editFormAttributes;

        if (!$editedGroup->validate()) {
            throw new CHttpException(400, 'error in request');
        }

        $editedGroup->id = Yii::app()->request->getPost('id');

        $attributesGroup = $editedGroup->getAttributes();

        Yii::app()->db->createCommand()
            ->update(
                'groups',
                [
                    'name' => $attributesGroup['groupName'],
                    'direction_id' => $attributesGroup['directionID'],
                    'location_id' => $attributesGroup['locationID'],
                    'budget' => $attributesGroup['budgetOwner'],
                    'start_date' => $attributesGroup['startDate'],
                    'finish_date' => $attributesGroup['finishDate']
                ],
                'id=:id',
                [':id' => $attributesGroup['id']]
            );

        Yii::app()->db->createCommand()
            ->insert(
                'user_groups',
                [
                    'group' => $attributesGroup['id'],
                    'user' => $attributesGroup['teacherID']
                ]
            );

        Yii::app()->db->createCommand()
            ->insert(
                'group_experts',
                [
                    'group' => $attributesGroup['id'],
                    'name' => $attributesGroup['expertName']
                ]
            );

        $this->renderJson(["success" => true]);
    }
}
