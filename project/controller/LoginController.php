<?php

namespace controller;

class LoginController {

    private $loginView;
    private $logedInView;
    private $navigationView;
    private $fileDAL;
    private $userDAL;


    private $view;

    public function __construct(\view\LoginView $lv, \view\LogedInView $lov, \view\NavigationView $nav, \model\fileDAL $fileDAL, \model\UserDAL $userDAL ){
        $this->loginView = $lv;
        $this->logedInView = $lov;
        $this->navigationView = $nav;
        $this->fileDAL = $fileDAL;
        $this->userDAL = $userDAL;


    }

    public function doLogin(){

        if($this->loginView->checkLoginPost()){
            $user = $this->loginView->getUser();
            if($user != null){
                $this->view = $this->logedInView->generateLogedinSite($this->fileDAL->getAllFiles());
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
