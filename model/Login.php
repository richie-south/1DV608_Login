<?php

class Login {
    private static $username = 'Admin';
    private static $password = 'Password';
    private $message = '';

    public function __construct() {
    }

    /**
    * sets message
    * @param $userName, String | $password, String
    * @return true/false
    */
    public function checkValues($userName, $password){
        if(empty($userName)){
            $this->setMessage('Username is missing');
            return false;
        }
        
        if(empty($password)){
            $this->setMessage('Password is missing');
            return false;
        }

		if(!$this->compareUserName($userName) || !$this->comparePassword($password)){
            $this->setMessage('Wrong name or password');
            return false;
		}

        $this->setMessage('Welcome');
        return true;
    }

    /**
    * stores a massage in variable $message
    * @param $message, String
    * @return null
    */
    public function setMessage($message){
        $this->message = $message;
    }

    /**
    * @return variabel @message
    */
    public function getMessage(){
        return $this->message;
    }

    /**
    * checks is inputed username matches stored variable $username
    * @param $username, String, user name
    * @return true/false
    */
    private function compareUserName($username){
        return $username == self::$username;
    }

    /**
    * checks is inputed password matches stored variable $password
    * @param $password, String, password
    * @return true/false
    */
    private function comparePassword($password){
        return $password == self::$password;
    }

}
