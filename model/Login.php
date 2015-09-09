<?php

/**
 *
 */
class Login {
    private static $username = 'Admin';
    private static $password = 'Password';

    public function __construct() {
        //TODO: write here!
    }

    public function compareUserName($userName){
        return $userName == self::$username && !empty($userName);
    }

    public function comparePassword($password){
        return $password == self::$password && !empty($password);
    }

    public function checkEmpty($string){
        return empty($string);
    }

}
