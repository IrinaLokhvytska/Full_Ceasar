<?php

class StudentListController extends CController
{

    public function actionEnglishTable($group_id)
    {
        /** @var StudentComponent $component */
        $rawData = Yii::app()->getComponent('Student')->getStudentList($group_id);
        $arrayDataProvider = new CArrayDataProvider($rawData, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array(
                    'Name', 'English level',
                ),
            ),
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
        $params = array(
            'arrayDataProvider' => $arrayDataProvider,
        );
        $this->renderPartial('../site/studentList', $params);
    }

    public function actionScoreTable($group_id)
    {
        /** @var StudentComponent $component */
        $rawData = Yii::app()->getComponent('Student')->getStudentList($group_id);
        $arrayDataProvider = new CArrayDataProvider($rawData, array(
            'id' => 'id',
            'sort' => array(
                'attributes' => array(
                    'Name', 'Entry score',
                ),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $params = array(
            'arrayDataProvider' => $arrayDataProvider,
        );
        $this->render('../site/studentScore', $params);
    }
}
