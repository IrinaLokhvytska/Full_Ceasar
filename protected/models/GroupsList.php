<?php

class GroupsList extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'directions';
    }

    public function getGroupsList($locations)
    {
        if (!isset($locations) || $locations === 'undefined') {
            $locations = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        } else {
            $locations = $this->requestParametersParse($locations);
        }


//        $criteria = new CDbCriteria();
////        $criteria->alias = 'directions d'
////        $criteria->select = 'directions.name, groups.name';
////        $criteria->addInCondition('location', $locations);
//        $criteria->join = "INNER JOIN groups ON id = groups.direction";
//        $groupsList = GroupsList::model()->findAll($criteria);

//        $groups = Yii::app()->db->createCommand()
//            ->select('groups.name, directions.name')
//            ->from('groups, directions')
//            ->join('directions', 'groups.direction=directions.id')
//            ->queryRow();

//        $criteria = new CDbCriteria();
//        $criteria->select = ['directions.name', 'groups.name'];
//        $criteria->join = 'INNER JOIN groups g ON directions.id = groups.direction';
//        $groupsList = GroupsList::model()->findAll($criteria);

        $groupsList = Yii::app()->db->createCommand('SELECT d.name as direction_name, g.name as group_name FROM directions d INNER JOIN groups g ON d.id = g.direction')->queryAll();

        return empty($groupsList) ? [] : $groupsList;
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
