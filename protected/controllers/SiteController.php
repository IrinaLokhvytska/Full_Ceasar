<?php

class SiteController extends Controller {
    /* public function actionIndex()
      {
      $this->layout = "login_layout_caesar";

      $this->render('login_page_caesar');
      } */

    public function actionIndex() 
    {
        $model = new LoginForm();

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect("site/main");
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
            $this->redirect(Yii::app()->request->baseUrl . "/site/index");
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

    public static function actionSetup() 
    {
        $auth = Yii::app()->authManager;
        $auth->createOperation('createGroup');
        $auth->createOperation('updateGroup');
        $auth->createOperation('deleteGroup');
        $auth->createOperation('createUser');
        $auth->createOperation('updateUser');
        $auth->createOperation('deleteUser');

        $task = $auth->createTask('createOwnLocationGroup', 'Allows a user to create his own location  group', 'return $params["id"] == Yii::app()->user->id;');
        $task->addChild('createGroup');

        $task = $auth->createTask('updateOwnLocationGroup', 'Allows a user to update his own location group', 'return $params["id"] == Yii::app()->user->id;');
        $task->addChild('updateGroup');

        $task = $auth->createTask('deleteOwnLocationGroup', 'Allows a user to delete his own location group', 'return $params["id"] == Yii::app()->user->id;');
        $task->addChild('deleteGroup');

        $task = $auth->createTask('updateOwnUser', 'Allows a user to update his record', 'return $params["id"] == Yii::app()->user->id;');
        $task->addChild('updateUser');

        $role = $auth->createRole('teacher');
        $role->addChild('updateOwnLocationGroup');
        $role->addChild('updateOwnUser');

        $role = $auth->createRole('coordinator');
        $role->addChild('teacher');
        $role->addChild('createOwnLocationGroup');
        $role->addChild('deleteOwnLocationGroup');

        $role = $auth->createRole('administrator');
        $role->addChild('createGroup');
        $role->addChild('updateGroup');
        $role->addChild('deleteGroup');
        $role->addChild('createUser');
        $role->addChild('updateUser');
        $role->addChild('deleteUser');
     
        /*if ($role === 'teacher') {
            $auth->assign('teacher', $user->id);
        } elseif ($role === 'coordinator') {
            $auth->assign('coordinator', $user->id);
        } elseif ($role === 'administrator') {
            $auth->assign('administrator', $user->id);
        }
        $auth->save();*/
        return $auth;
    }

}
