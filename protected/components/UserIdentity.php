<?php
class UserIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        $user = User::model()->findByAttributes(['username'=>$this->username]);
        if ($user === null) { // No user found!
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== $this->password ){ // Invalid password! Sha1
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else { // Okay!
            $this->_id=$user->id;
            $this->setState('firstname', $user->first_name);
            $this->setState('lastname', $user->last_name);
            $this->setState('type', $user->type);
            $this->setState('location', $user->location_id);
            $this->setState('picture', $user->picture);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
    public function getId()
    {
        return $this->_id;
    }
}