<?php

class LoginControl {

    private $loginModel;
    private $loginView;
    private $isLogedIn = false;

    public function __construct(Login $loginModel, LoginView $v){
        $this->loginModel = $loginModel;
        $this->liginView = $v;
    }

    public function doLogin(){
        //return $this->loginView->checkValues();

    }

    public function isLogedin(){
        return $this->isLogedIn;
    }

}
