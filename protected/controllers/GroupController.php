<?php

class GroupController extends BaseController
{
    public function actionCreate()
    {
        $createFormAttributes = Yii::app()->request->getPost('CreateForm', []);
        if (empty($createFormAttributes)) {
            throw new CHttpException(400, 'Invalid data');
        }
        $newGroup = new GroupForm();
        $newGroup->attributes = $createFormAttributes;
        if (!$newGroup->validate()) {
            throw new CHttpException(400, 'error in request');
        }
        $attributesGroup = $newGroup->getAttributes();
        Yii::app()->db->createCommand()
            ->insert(
                'groups',
                [
                    'name' => $attributesGroup['groupName'],
                    'direction_id' => $attributesGroup['directionID'],
                    'location_id' => $attributesGroup['locationID'],
                    'budget' => $attributesGroup['budgetOwner'],
                    'date_start' => $attributesGroup['startDate'],
                    'date_finish' => $attributesGroup['finishDate']
                ]
            );
        $groupID = Yii::app()->db->createCommand()
            ->select('id')
            ->from('groups')
            ->where('name=:name', [':name' => $attributesGroup['groupName']])
            ->queryAll();
        Yii::app()->db->createCommand()
            ->insert(
                'user_groups',
                [
                    'id_group' => $groupID,
                    'user_id' => $attributesGroup['teacherID']
                ]
            );
        Yii::app()->db->createCommand()
            ->insert(
                'experts',
                [
                    'id_group' => $groupID,
                    'name' => $attributesGroup['expertName']
                ]
            );
        $this->renderJson(["success" => true]);
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
            ->select('first_name, last_name, full_name')
            ->from('user_roles ur')
            ->join('users u', 'ur.id=u.id')
            ->join('locations l', 'u.location=l.id')
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
            ->select('firstname, lastname, id')
            ->from('user_groups ug')
            ->join('users u', 'ug.user_id = u.id')
            ->where('group_id=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();
        $experts = Yii::app()->db->createCommand()
            ->select('name, id')
            ->from('experts')
            ->where('group_id=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();
        $groups = Yii::app()->db->createCommand()
            ->select('*')
            ->from('groups g')
            ->join('directions d', 'g.direction_id = d.id')
            ->join('locations l', 'g.location_id = l.id')
            ->where('id=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();
        $groups = empty($groups) ? [] : $groups;
        $teachers = empty($teachers) ? [] : $teachers;
        $experts = empty($experts) ? [] : $experts;
        $groups[] = $teachers;
        $groups[] = $experts;
        $this->renderJson($groups);
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
                    'date_start' => $attributesGroup['startDate'],
                    'date_finish' => $attributesGroup['finishDate']
                ],
                'id_group=:id',
                [':id'=>$attributesGroup['id']]
            );
        Yii::app()->db->createCommand()
            ->insert(
                'user_groups',
                [
                    'id_group' => $attributesGroup['id'],
                    'user_id' => $attributesGroup['teacherID']
                ]
            );
        Yii::app()->db->createCommand()
            ->insert(
                'experts',
                [
                    'id_group' => $attributesGroup['id'],
                    'name' => $attributesGroup['expertName']
                ]
            );
        $this->renderJson(["success" => true]);
    }
}
