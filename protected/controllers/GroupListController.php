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

    public function actionGetMyGroupList()
    {
        /** @var GroupComponent $component */
        $component = Yii::app()->getComponent('Group');
        $myGroupList = $component->getMyList();
        $this->renderJSON($myGroupList);
    }
}
