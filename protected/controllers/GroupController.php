<?php

class GroupController extends BaseController
{
    public function actionCreate()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);



//        if (empty($createFormAttributes)) {
//            throw new CHttpException(400, 'Invalid data');
//        }
//
//        $newGroup = new GroupForm();
//        $newGroup->attributes = $data;

//        if (!$newGroup->validate()) {
//            throw new CHttpException(400, 'error in request');
//        }

//        $attributesGroup = $newGroup->getAttributes();

        Yii::app()->db->createCommand()
            ->insert(
                'groups',
                [
                    'name' => $data['name'],
                    'direction' => $data['direction'],
                    'location' => $data['location'],
                    'budget' => $data['budgetOwner'],
                    'start_date' => $data['startDate'],
                    'finish_date' => $data['finishDate'],
                    'expert' =>''
                ]
            );

//        $groupID = Yii::app()->db->createCommand()
//            ->select('id')
//            ->from('groups')
//            ->where('name=:name', [':name' => $attributesGroup['groupName']])
//            ->queryAll();
//
//        Yii::app()->db->createCommand()
//            ->insert(
//                'user_groups',
//                [
//                    'group' => $groupID[0]['id'],
//                    'user' => $attributesGroup['teacherID']
//                ]
//            );
//
//        Yii::app()->db->createCommand()
//            ->insert(
//                'group_experts',
//                [
//                    'group' => $groupID,
//                    'name' => $attributesGroup['expertName']
//                ]
//            );
//
//        $this->renderJson(["success" => true]);
    }

    public function actionDelete()
    {
        Yii::app()->db->createCommand()
            ->delete('groups', 'id=:id', [':id' => Yii::app()->request->getParam('id')]);

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

    public function actionGetLocationsList()
    {
        $locations = Yii::app()->db->createCommand()
            ->select('name, id')
            ->from('user_roles')
            ->queryAll();

        $locations = empty($locations) ? [] : $locations;

        $this->renderJson($locations);
    }

    public function actionGetDirectionsList()
    {
        $directions = Yii::app()->db->createCommand()
            ->select('name, id')
            ->from('directions')
            ->queryAll();

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
