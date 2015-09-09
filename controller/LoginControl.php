<?php

class LoginControl {

    private $loginModel;
    private $view;

    public function __construct(Login $loginModel, LoginView $v){
        $this->loginModel = $loginModel;
        $this->view = $v;
    }

    public function doLogin(){
        return $this->loginModel->isLogin();
    }
}
