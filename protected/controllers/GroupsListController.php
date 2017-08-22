<?php

class GroupsListController extends BaseController
{
    public function actionGetGroupsList($par)
    {
        $groupsList = GroupsList::model()->getGroupsList($par);
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
