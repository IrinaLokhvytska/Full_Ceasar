<?php

class GroupComponent extends CApplicationComponent
{
    public function getList($locationNames)
    {
        if ($locationNames !== 'undefined') {
            $locationNames = json_encode($locationNames);
            $locations = $this->getLocationsId($locationNames);
        } else {
            $locations = [Yii::app()->user->location];
        }

        $criteria = new CDbCriteria();
        $criteria->alias = 'group';
        $criteria->select = "{$criteria->alias}.name";
        $criteria->addInCondition('location', $locations);
        /** @var Group[] $rows */
        $rows = Group::model()->with('direction')->findAll($criteria);

        $result = [];
        if (empty($rows)) {
            return $result;
        }
        foreach ($rows as $row) {
            $result[] = [
                'group_name' => $row->name,
                'direction_name' => $row->getRelated('direction')->name
            ];
        }

        return empty($result) ? [] : $result;
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
}
