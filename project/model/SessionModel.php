<?php
// TODO: Fix this class
namespace model;

class SessionModel {

    private static $uploadSession = "status";

    public function __construct(){
        session_start();
    }

    public function setUploadSession($val){
        $_SESSION[self::$val] = $val;
    }

    public function destroyUploadSession(){
        unset($_SESSION[self::$uploadSession]);
    }

    public function isUploadSessionSet(){
        return isset($_SESSION[self::$uploadSession]);
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
