<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findBySql("select * from user where 
                                username='{$this->username}'
                                and status!='User::ACTIVED'");

        if (empty($user)){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }else if($user->password != md5($this->password)){
            $this->errorCode = self::ERROR_PASSWORD_INVALID;            
        }else {
            $this->_id = $user->id;
			yii::app()->user->setState('userSessionTimeout', (time()+Yii::app()->params['loginTimeoutSeconds']));

            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;

		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'Test123',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;*/
	}
	public function getId()
	{
		return $this->_id;
	}

}