<?php
class LocationsController extends BaseController
{
    public function actionGetLocations()
    {
        /** @var LocationComponent $component */
        $component = Yii::app()->getComponent('Location');
        $locationList = $component->getList();
        $this->renderJSON($locationList);
    }

    public function actionGetAllLocations()
    {
        $locations = Locations::model()->findAll();
        $this->renderJSON($locations);
    }
}
