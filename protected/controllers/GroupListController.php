<?php

class GroupListController extends BaseController
{
    public function actionGetGroupList($par)
    {
        /** @var GroupComponent $component */
        $component = Yii::app()->getComponent('Group');
        $groupList = $component->getList($par);
        $this->renderJSON($groupList);
    }

    public function actionShowGroup($par)
    {
//        $groupInfo = GroupInfo::model()->getGroupInfo($groupName);
//        $this->renderJSON($groupInfo);
    }

    public function actionGetMyGroupList()
    {
        $groupList = GroupList::model()->getMyGroupList();
        $this->renderJSON($groupList);
    }
}
