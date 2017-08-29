<?php

class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $user = User::model()->findByAttributes(['username'=>$this->username]);

        if ($user === null) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== $this->password ){ 
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else { 
            $this->_id = $user->id;
            $this->setState('firstname', $user->first_name);
            $this->setState('lastname', $user->last_name);
            $this->setState('type', $user->type);
            $location = Locations::model()->findByAttributes(['id'=>$user->location_id]); 
            $this->setState('location', $location->full_name);
            $user_roles = UserRoles::model()->findByAttributes(['user_id'=>$user->id]);
            $role = Roles::model()->findByAttributes(['id'=>$user_roles->role_id]);
            $this->setState('role', $role->name);
            $this->setState('picture', $user->picture);
            $this->errorCode=self::ERROR_NONE;
            
            /*
            $auth = SiteController::actionSetup();             
            if ($role->name === 'teacher') {
                $auth->assign('teacher', $user->id);
            } elseif ($role->name === 'coordinator') {
                $auth->assign('coordinator', $user->id);
            } elseif ($role->name === 'administrator') {
                $auth->assign('administrator', $user->id);
            }
              $auth->save();*/
          }
              
        return !$this->errorCode;
    }
    public function getId()
    {
        return $this->_id;
    }
}
