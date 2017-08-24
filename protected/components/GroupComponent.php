<?php

class GroupComponent extends CApplicationComponent
{
    public function getList($locations)
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'group';
        $criteria->select = "{$criteria->alias}.name";
        if ($locations !== 'undefined') {
            $locations = json_decode($locations);
            $criteria->addInCondition('location', $locations);
        }
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
}
