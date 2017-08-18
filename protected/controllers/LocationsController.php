<?php

class LocationsController extends BaseController
{
    public function actionGetLocations()
    {
        $locations = Locations::model()->getLocations();
        $this->renderJSON($locations);
    }

    public function actionShowLocations($locations)
    {
        $this->renderJSON($locations);
    }
}
