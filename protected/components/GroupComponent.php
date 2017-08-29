<?php

class GroupComponent extends CApplicationComponent
{
    public function getList($locationNames)
    {
        $locationsIdList = $this->checkLocations($locationNames);

        $criteria = new CDbCriteria();
        $criteria->alias = 'group';
        $criteria->addInCondition('location_id', $locationsIdList);
        /** @var Group[] $rows */
        $rows = Group::model()->with('direction')->findAll($criteria);

        $result = [];
        $groupList = [];
        $locationNameList = [];
        if (empty($rows)) {
            return $result;
        }
        foreach ($rows as $row) {
            $groupList[] = [
                'group_id' => $row->id,
                'group_name' => $row->name,
                'group_location' => $row->getRelated('location')->full_name,
                'direction_name' => $row->getRelated('direction')->name,
                'start_date' => $row->start_date,
                'budget' => $row->budget,
                'direction_id' => $row->getRelated('direction')->id,
                'group_location_id' => $row->getRelated('location')->id,
                'finish_date' => $row->finish_date,
            ];
            $locationName = $row->getRelated('location')->full_name;
            if (array_search($locationName, $locationNameList, true) === false) {
                $locationNameList[] = $locationName;
            }
        }
        $result = [$groupList, $locationNameList];

        return $result;
    }

    public function checkLocations($locationNames)
    {
        if ($locationNames === Yii::app()->user->location || $locationNames === '') {
            $locations = [Yii::app()->user->location];
        } else {
            $locationNames = json_encode($locationNames);
            $locations = $this->getLocationsId($locationNames);
        }
        return empty($locations) ? [] : $locations;
    }

    public function getLocationsId($locationNames)
    {
        $locationIdList = [];
        $locationNames = explode(',', $locationNames);

        $criteria = new CDbCriteria();
        $criteria->select = 'id, full_name';
        $locationList = Locations::model()->findAll($criteria);

        foreach ($locationNames as $locationName) {
            $locationName = preg_replace('/[^A-Za-z0-9\-]/', '', $locationName);
            foreach ($locationList as $location) {
                if ($locationName === $location->full_name) {
                    $locationIdList[] = $location->id;
                }
            }
        }

        return $locationIdList;
    }

    public function getMyList()
    {
        $userId = Yii::app()->user->id;
        $userGroups = [];

        $criteria = new CDbCriteria();
        $criteria->alias = 'user_group';
        $criteria->condition = "$userId = {$criteria->alias}.user";
        /** @var UserGroup[] $rows */
        $rows = UserGroup::model()->with('group')->findAll($criteria);

        $result = [];
        if (empty($rows)) {
            return $result;
        }
        foreach ($rows as $row) {
            $result[] = [
                'group_id' => $row->getRelated('group')->id,
                'group_name' => $row->getRelated('group')->name,
                'group_location' => $row->getRelated('group')->getRelated('location')->full_name,
                'direction_name' => $row->getRelated('group')->getRelated('direction')->name,
                'start_date' => $row->getRelated('group')->start_date,
                'budget' => $row->getRelated('group')->budget,
                'direction_id' => $row->getRelated('group')->getRelated('direction')->id,
                'group_location_id' => $row->getRelated('group')->getRelated('location')->id,
                'finish_date' => $row->getRelated('group')->finish_date,
            ];
        }

        return $result;
    }

    public function createGroup()
    {
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

        if (!$group->validate()) {
            throw new CHttpException(400, 'Invalid data');
        }
        $group->save();
        $groupId = $group->id;

        $groupTeachers = $data['teachers'];
        foreach ($groupTeachers as $key => $value) {
            $teacher = new Teacher();
            $teacher->setAttribute('group', $groupId);
            $teacher->setAttribute('user', $value);
            $teacher->save();
        }

        $experts = $data['experts'];
        if (!empty($experts)) {
            foreach ($experts as $person) {
                $expert = new Expert();
                $expert->group = $groupId;
                $expert->name = $person;
                $expert->save();
            }
        }
    }

    public function deleteGroup($id)
    {
        $groupId = $id;

        if (!$groupId) {
            throw new CHttpException(400, 'Invalid data');
        }

        $group = new Group();
        $group->findByPk($groupId)->delete();
    }

    public function editGroup()
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

        if (!$group->validate()) {
            throw new CHttpException(400, 'Invalid data');
        }
        $group->update();

        $criteria = new CDbCriteria();
        $criteria->alias = 'user_group';
        $criteria->condition = "$idGroup = {$criteria->alias}.group";
        $rows = UserGroup::model()->with('group')->findAll($criteria);
        foreach ($rows as $row) {
            $row->delete();
        }

        $groupTeachers = $data['teachers'];
        foreach ($groupTeachers as $value) {
            $teacher = new Teacher();
            $teacher->setAttribute('group', $idGroup);
            $teacher->setAttribute('user', $value);
            $teacher->save();
        }

        $criteria = new CDbCriteria();
        $criteria->alias = 'group_experts';
        $criteria->condition = "$idGroup = {$criteria->alias}.group";
        $rows = Expert::model()->findAll($criteria);
        foreach ($rows as $row) {
            $row->delete();
        }

        $experts = $data['experts'];
        if (!empty($experts)) {
            foreach ($experts as $person) {
                $expert = new Expert();
                $expert->group = $idGroup;
                $expert->name = $person;
                $expert->save();
            }
        }
    }
}
