<?php

class GroupsListController extends BaseController
{
    public function actionGetGroupsList($par)
    {
        /** @var GroupListComponent $component */
        $component = Yii::app()->getComponent('GroupListComponent');
        $groupsList = $component->get();
        $this->renderJSON($groupsList);
    }

    public function actionShowGroup($par)
    {
//        $groupInfo = GroupInfo::model()->getGroupInfo($groupName);
//        $this->renderJSON($groupInfo);
    }

    public function actionGetMyGroupsList()
    {
        $groupsList = GroupsList::model()->getMyGroupsList();
        $this->renderJSON($groupsList);
    }
}
