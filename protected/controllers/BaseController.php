<?php

abstract class BaseController extends CController
{
    protected function renderJson(array $data)
    {
        header('Content-type: application/json');
        echo CJSON::encode($data);
        Yii::app()->end();
    }
}
