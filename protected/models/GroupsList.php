<?php

class GroupsList extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'groups';
    }

    public function requestParametersParse($params)
    {
        if (strpos($params, ',')) {
            $params = explode(',', $params);
        } else {
            $params = [$params];
        }

        return $params;
    }

    public function getGroupsList($locations)
    {
        $locations = $this->requestParametersParse($locations);

        if (!isset($locations) || $locations === 'undefined') {
            $locations = [2];
        }

        $criteria = new CDbCriteria();
        $criteria->select = 'name, direction';
        $criteria->addInCondition('location', $locations);
        $groupsList = GroupsList::model()->findAll($criteria);
//
//        if (strpos($locations, ',')) {
//            $locations = explode(',', $locations);
//        }
//
//
//        $groupsList = [
//            ['groupName' => 'LV17', 'groupDirection' => 'Java'],
//            ['groupName' => 'DP19', 'groupDirection' => 'PHP'],
//            ['groupName' => 'KH20', 'groupDirection' => 'JS'],
//            ['groupName' => 'ZP11', 'groupDirection' => 'JS'],
//            ['groupName' => 'DP12', 'groupDirection' => 'Java'],
//            ['groupName' => 'RV18', 'groupDirection' => 'PHP'],
//            ['groupName' => 'CH14', 'groupDirection' => 'GO'],
//            ['groupName' => 'KV13', 'groupDirection' => 'Java'],
//            ['groupName' => 'LV22', 'groupDirection' => 'JS'],
//            ['groupName' => 'KH24', 'groupDirection' => 'PHP'],
//            ['groupName' => 'ZP21', 'groupDirection' => 'Java'],
//            ['groupName' => 'DP23', 'groupDirection' => 'JS'],
//        ];
//
//        if (is_array($locations)) {
//            if ($locations[0] === 'DP') {
//                $groupsList = [
//                    ['groupName' => 'LV17', 'groupDirection' => 'Java'],
//                    ['groupName' => 'DP19', 'groupDirection' => 'PHP'],
//                    ['groupName' => 'KH20', 'groupDirection' => 'JS'],
//                ];
//            }
//            if ($locations[1] === 'LV')
//            {
//                $groupsList[] = ['groupName' => 'LV22', 'groupDirection' => 'JS'];
//            }
//        } else {
//            if ($locations === 'DP') {
//                $groupsList = [
//                    ['groupName' => 'LV17', 'groupDirection' => 'Java'],
//                    ['groupName' => 'KH20', 'groupDirection' => 'JS'],
//                ];
//            }
//        }
//
//

        return $groupsList;
    }

    public function getMyGroupsList()
    {
//        $userId = UserSessionInfo::getUserId();

//        $userId = 1;
//
//        $criteria = new CDbCriteria();
//        $criteria->select = 'name, direction';
//        $myGroupsList = GroupsList::model()->with(array(
//            'user_groups'=>array(
//                'select'=>false,
//                'joinType'=>'INNER JOIN',
//                "condition'=>'user_groups.user=$userId",
//            ),
//        ))->findAll($criteria);

        $myGroupsList = [
            ['DP19', 'PHP'],
            ['KH20', 'JS'],
            ['ZP11', 'JS'],
        ];

        return $myGroupsList;
    }
}
