<?php

/**
 *
 */
class Login {
    private static $username = 'Admin';
    private static $password = 'Password';
    private $message = '';
    public function __construct() {
        //TODO: write here!
    }

    public function checkValues($userName, $password){
        echo "use me";
        if(empty($userName)){
            $this->message = 'Empty username field';
            return false;
        }
        if(empty($password)){
            $this->message = 'Empty password field';
            return false;
        }

		if($this->compareUserName($userName) && $this->comparePassword($password)){
            $this->message = 'Logged in';
            return true;
		}
        $this->message = 'Wrong username or password';
        return false;

    }

    public function getMessage(){
        return $this->message;
    }

    private function compareUserName($userName){
        return $userName == self::$username;
    }

    private function comparePassword($password){
        return $password == self::$password;
    }

}
