<?php

namespace model;

class Login {
    private $message = '';
    private $userDAL;

    public function __construct(\model\UserDAL $userDAL) {
        $this->userDAL = $userDAL;
    }

    /**
    * sets message
    * @param $userName, String | $password, String
    * @return true/false
    */
    public function checkValues($userName, $password){
        if(empty($userName)){
            $this->setMessage('Username is missing');
            return false;
        }

        if(empty($password)){
            $this->setMessage('Password is missing');
            return false;
        }

        if(!$this->userDAL->correctCredentials($userName, $password)){
            $this->setMessage('Wrong name or password');
            return false;
        }

        $this->setMessage('Welcome');
        return true;
    }

    /**
    * stores a massage in variable $message
    * @param $message, String
    * @return null
    */
    public function setMessage($message){
        $this->message = $message;
    }

    /**
    * @return variabel @message
    */
    public function getMessage(){
        return $this->message;
    }


}
