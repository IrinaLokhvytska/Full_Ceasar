<?php

class ScheduleController extends BaseController
{
    public function actionGetSchedule()
    {
        $schedule = Schedule::model()->getSchedule();
        $this->renderJSON($schedule);
    }
}
