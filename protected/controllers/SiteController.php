<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "login_layout_caesar";

        $this->render('login_page_caesar');
    }

    public function actionMain()
    {
        $this->layout = "main";

        $this->render('main');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }
}
