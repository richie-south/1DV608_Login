<?php

namespace view;

class NavigationView {

    private static $viewFile = "f";

    public function __construct(){

    }

    public function userWantsToViewFile(){
        return isset($_GET[self::$viewFile]);
    }

    public function getURLFileData(){
        return $_GET[self::$viewFile];
    }
    
}
