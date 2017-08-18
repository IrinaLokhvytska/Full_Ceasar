<?php

class Notifications extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'notifications';
    }

    public function getNotifications()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'notification_text';
        $notifications = Notifications::model()->findAll($criteria);

        return $notifications;
    }
}
