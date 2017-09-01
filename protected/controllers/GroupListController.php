<?php

class GroupListController extends BaseController
{
    public function actionGetGroupList($locations)
    {
        /** @var GroupComponent $component */
        $component = Yii::app()->getComponent('Group');
        $groupList = $component->getList($locations);
        $this->renderJSON($groupList);
    }

    public function actionGetMyGroupList()
    {
        /** @var GroupComponent $component */
        $component = Yii::app()->getComponent('Group');
        $myGroupList = $component->getMyList();
        $this->renderJSON($myGroupList);
    }
}
