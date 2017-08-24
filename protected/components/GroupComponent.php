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
            foreach ($locationList as $locationId) {
                if ($locationName === $locationId['full_name']) {
                    $locationIdList[] = $locationId['id'];
                }
            }
        }

        return $locationIdList;
    }
}
