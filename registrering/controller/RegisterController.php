<?php

namespace controller;

class RegisterController {

    private $userDAL;
    private $registerView;
    private $session;

    public function __construct(\model\UserDAL $userDAL, \view\RegisterView $rv, \model\Session $session, \view\NavigationView $navView){

        $this->userDAL = $userDAL;
        $this->registerView = $rv;
        $this->session = $session;
        $this->navView = $navView;
    }
    
    public function registrations(){

        if($this->registerView->checkDoRegistrationPost()){
            $username = $this->registerView->checkUserNamePost();
            $password = $this->registerView->checkPasswordPost();

            $user = $this->registerView->getUser();
            if($user != null){
                try {
                    $this->userDAL->save($user);
                    $this->navView->redirectToStart();
                    $this->session->setUserNameSession($user->getUsername());
                    die();
                } catch (Exception $e) {
                    $this->registerView->setDuplicate();
                }
            }
        }

    }

}
