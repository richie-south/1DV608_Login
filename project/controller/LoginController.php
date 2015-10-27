<?php

namespace controller;

class LoginController {

    private $loginView;
    private $logedInView;
    private $fileDAL;
    private $sessionView;

    private $view;

    public function __construct(\view\LoginView $lv, \view\LogedInView $lov, \model\fileDAL $fileDAL, \view\SessionView $sv){
        $this->loginView = $lv;
        $this->logedInView = $lov;
        $this->fileDAL = $fileDAL;
        $this->sessionView = $sv;
    }

    public function doLogin(){
        if($this->sessionView->isLogedInSessionSet()){
            $this->view = $this->logedInView->generateLogedinSite($this->fileDAL->getAllFiles());

        }else if($this->loginView->checkLoginPost()){
            $user = $this->loginView->getUser();
            if($user != null){
                $this->view = $this->logedInView->generateLogedinSite($this->fileDAL->getAllFiles());
                $this->sessionView->setLogedInSession(true);
            } else {
                $this->view = $this->loginView->generateLoginFormHTML();
            }

        }else{
            $this->view = $this->loginView->generateLoginFormHTML();
        }
    }

    public function getHTML(){
        return $this->view;
    }
}
