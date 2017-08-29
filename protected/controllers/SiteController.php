<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = new LoginForm();
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->request->baseUrl . "/site/main");
        }
        $this->layout = "login_layout_caesar";
        $this->render('login_page_caesar', array('model' => $model));
    }

    public function actionMain()
    {
        if (Yii::app()->user->id) {
            $this->layout = "main";
            $this->render('main');
        } else {
            $this->redirect(Yii::app()->request->baseUrl . '/site/index');
        }
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
