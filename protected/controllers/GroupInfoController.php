<?php

class GroupInfoController extends BaseController
{
    public function actionGetGroupInfo()
    {
        $groupInfo = GroupInfo::model()->getGroupInfo();
        $this->renderJSON($groupInfo);
    }
}
