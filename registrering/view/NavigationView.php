<?php

namespace view;

class NavigationView {

    private static $registrationURL = "register";

    public function __construct() {
    }

    public function getLinkToLogin(){
        return '<a href="?">Back to login</a>';
    }

    public function getLinkToRegistration(){
        return '<a href=?'.self::$registrationURL.'>Register a new user</a>';
    }

    public function userWantsToRegistrate(){
        if (isset($_GET[self::$registrationURL]) ) {
			return true;
		}
		return false;
    }

    public function redirectToStart(){
        header("Location: http://richardsoderman.se/phpRegistration/");
        //header("Location: http://localhost:8000/");
    }
}
