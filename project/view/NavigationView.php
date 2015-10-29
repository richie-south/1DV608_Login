<?php

namespace view;

class NavigationView {

    private static $viewFile = "f";
    private static $login = "login";

    public function __construct(){
    }

    public function userWantsToViewFile(){
        return isset($_GET[self::$viewFile]);
    }

    public function getURLFileData(){
        return $_GET[self::$viewFile];
    }

    public function makeFileNameUrl($fileName){
        return "http://$_SERVER[HTTP_HOST]/phpproject?".self::$viewFile."=$fileName";
    }

    public function userWantsToLogin(){
        return isset($_GET[self::$login]);
    }

    public function getLoginURL(){
        return self::$login;
    }

    public function redirectToStart(){
        header("Location: http://$_SERVER[HTTP_HOST]/phpproject/");
        die();
    }



    public function backToStartNav(){
        return '<a href="?">Start</a>';
    }

    public function adminPage(){
        return '<a href="?'.self::$login.'">Admin dashboard</a>';
    }

    public function loginPage(){
        return '<a href="?'.self::$login.'">Admin login</a>';
    }
}
