<?php

class NotificationsController extends BaseController
{
    public function actionGetNotifications()
    {
        $notifications = Notifications::model()->getNotifications();
        $this->renderJSON($notifications);
    }
}
