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
                'group_name' => $row->name,
                'direction_name' => $row->getRelated('direction')->name,
                'group_id' => $row->id,
            ];
            $locationName = $row->getRelated('location')->full_name;
            if (array_search($locationName, $locationNameList, true) === false) {
                $locationNameList[] = $locationName;
            }
        }
        $result = [$groupList, $locationNameList];

        return empty($result) ? [] : $result;
    }

    public function checkLocations($locationNames)
    {
        if ($locationNames === Yii::app()->user->location || $locationNames === '') {
            $locations = [Yii::app()->user->location];
        } else {
            $locationNames = json_encode($locationNames);
            $locations = $this->getLocationsId($locationNames);
        }
        return $locations;
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
                'group_name' => $row->getRelated('group')->name,
                'direction_name' => $row->getRelated('group')->getRelated('direction')->name,
                'group_location' => $row->getRelated('group')->getRelated('location')->full_name,
            ];
        }

        return empty($result) ? [] : $result;
    }
}
