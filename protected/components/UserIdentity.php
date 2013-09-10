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
		$record=Users::model()->findByAttributes(array('login'=>$this->username));

		if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->pass!==md5(Yii::app()->params['salt'].$this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->_id=$record->id;

			$auth=Yii::app()->authManager;
	        if(!$auth->isAssigned($record->role, $this->_id))
	        {
	            if($auth->assign($record->role, $this->_id))
	            {
	                Yii::app()->authManager->save();
	            }
	        }

			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId()
    {
        return $this->_id;
    }
}