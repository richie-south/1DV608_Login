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
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?".self::$viewFile."=$fileName";
    }

    public function userWantsToLogin(){
        return isset($_GET[self::$login]);
    }

    public function getLoginURL(){
        return self::$login;
    }
}
