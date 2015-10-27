<?php

namespace view;

class SessionView {

    private static $loginSession = "status";

    public function __construct(){
        session_start();
    }

    public function setLogedInSession($val){
        $_SESSION[self::$loginSession] = $val;
    }

    public function destroyLogedInSession(){
        unset($_SESSION[self::$loginSession]);
    }

    public function isLogedInSessionSet(){
        return isset($_SESSION[self::$loginSession]) && $_SESSION[self::$loginSession] == true;
    }

}
