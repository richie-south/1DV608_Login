<?php

namespace model;

class Session {

    private static $val = "status";
    private static $val2 = "userName";

    public function __construct(){
        session_start();
    }

    /**
    * stores value in session
    * @param $val, boolean value to be stored in session
    * @return null
    */
    public function setSession($val){
        $_SESSION[self::$val] = $val;
    }

    /**
    * unsets session
    * @return null
    */
    public function destroySession(){
        unset($_SESSION[self::$val]);
    }

    /**
    * checks if session is set and if its true
    * @return boolean
    */
    public function isSessionSetTrue(){
        return isset($_SESSION[self::$val]) && $_SESSION[self::$val];
    }

    /**
    * stores value in session
    * @param $val, boolean value to be stored in session
    * @return null
    */
    public function setUserNameSession($val){
        $_SESSION[self::$val2] = $val;
    }

    /**
    * unsets session
    * @return null
    */
    public function destroyUserNameSession(){
        unset($_SESSION[self::$val2]);
    }

    public function getUserNameSession(){
        return $_SESSION[self::$val2];
    }
    /**
    * checks if session is set and if its true
    * @return boolean
    */
    public function isUserNameSessionSetTrue(){
        return isset($_SESSION[self::$val2]) && $_SESSION[self::$val2];
    }

}
