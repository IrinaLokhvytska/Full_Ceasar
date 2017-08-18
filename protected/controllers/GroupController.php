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
                'tbl_group',
                [
                    'name' => $attributesGroup['groupName'],
                    'direction' => $attributesGroup['direction'],
                    'location' => $attributesGroup['location'],
                    'teachers' => $attributesGroup['teachers'],
                    'budget_owner' => $attributesGroup['budgetOwner'],
                    'date_start' => $attributesGroup['startDate'],
                    'date_finish' => $attributesGroup['finishDate'],
                    'expert' => $attributesGroup['expert']
                ]
            )
            ->execute();

        $this->renderJson(["success" => true]);
    }

    public function actionDelete()
    {
        Yii::app()->db->createCommand()
            ->delete('tbl_group', 'id_group=:id', [':id' => Yii::app()->request->getParam('id')])
            ->execute();

        $this->renderJson(["success" => true]);
    }

    public function actionGetTeachersList()
    {
        $teachers = Yii::app()->db->createCommand()
            ->select('name')
            ->from('tbl_user')
            ->queryAll();

        $teachers = empty($teachers) ? [] : $teachers;

        $this->renderJson($teachers);
    }

    public function actionGetLocationsList()
    {
        $locations = Yii::app()->db->createCommand()
            ->select('name')
            ->from('tbl_location')
            ->queryAll();

        $locations = empty($locations) ? [] : $locations;

        $this->renderJson($locations);
    }

    public function actionGetDirectionsList()
    {
        $directions = Yii::app()->db->createCommand()
            ->select('name')
            ->from('tbl_direction')
            ->queryAll();

        $directions = empty($directions) ? [] : $directions;

        $this->renderJson($directions);
    }

    public function actionGetGroupsList()
    {
        $groups = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tbl_group')
            ->where('id_group=:id', [':id' => Yii::app()->request->getParam('id')])
            ->queryAll();

        $groups = empty($groups) ? [] : $groups;

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

        $attributesGroup = $editedGroup->getAttributes();
        $editedGroup->id = Yii::app()->request->getPost('id');

        Yii::app()->db->createCommand()
            ->update(
                'tbl_group',
                [
                    'id_group' => $attributesGroup['id'],
                    'name' => $attributesGroup['groupName'],
                    'direction' => $attributesGroup['direction'],
                    'location' => $attributesGroup['location'],
                    'teachers' => $attributesGroup['teachers'],
                    'budget_owner' => $attributesGroup['budgetOwner'],
                    'date_start' => $attributesGroup['startDate'],
                    'date_finish' => $attributesGroup['finishDate'],
                    'expert' => $attributesGroup['expert']
                ]
            )
            ->execute();

        $this->renderJson(["success" => true]);
    }
}
