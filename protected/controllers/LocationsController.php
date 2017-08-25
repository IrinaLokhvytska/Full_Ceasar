<?php
class LocationsController extends BaseController
{
    public function actionGetLocations()
    {
        /** @var LocationComponent $component */
        $component = Yii::app()->getComponent('Location');
        $locationList = $component->getList();
        $this->renderJSON($locationList);

//        $locations = Locations::model()->getLocations();
//        $this->renderJSON($locations);
    }
    public function actionShowLocations($par)
    {
        $this->renderJSON($par);
    }
}
