<?php


class DirectionComponent extends CApplicationComponent
{
    public function getDirectionsList()
    {
        $model = new Direction();
        $directions = $model->findAll();
        $directions = empty($directions) ? [] : $directions;
        
        return $directions;
    }
}