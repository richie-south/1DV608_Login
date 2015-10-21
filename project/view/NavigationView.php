<?php

namespace view;

class NavigationView {

    private static $viewFile = "f";
    private static $login = "login";
    private static $logout = "logout";

    public function __construct(){
    }

    public function userWantsToViewFile(){
        return isset($_GET[self::$viewFile]);
    }

    public function getURLFileData(){
        return $_GET[self::$viewFile];
    }

    public function makeFileNameUrl($fileName){
        return "http://$_SERVER[HTTP_HOST]?".self::$viewFile."=$fileName";
    }

    public function userWantsToLogin(){
        return isset($_GET[self::$login]);
    }

    public function userWantsToLogout(){
        return isset($_GET[self::$logout]);
    }

    public function getLoginURL(){
        return self::$login;
    }

    public function getLogoutURL(){
        return self::$logout;
    }

    public function redirectToStart(){
        header("Location: http://$_SERVER[HTTP_HOST]");
        die();
    }
}
