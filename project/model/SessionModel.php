<?php
// TODO: Fix this class
namespace model;

class SessionModel {

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


/*
//create digest of the form submission:

    $messageIdent = md5($_POST['name'] . $_POST['email'] . $_POST['phone'] . $_POST['comment']);

//and check it against the stored value:

    $sessionMessageIdent = isset($_SESSION['messageIdent'])?$_SESSION['messageIdent']:'';
    if($messageIdent!=$sessionMessageIdent){//so long as its different

        //save the session var:
            $_SESSION['messageIdent'] = $messageIdent;

        //do_your_thang();
    }*/
