<?php

class RegisterController {

    private $userDAL;
    private $registerView;

    public function __construct(\model\UserDAL $userDAL, RegisterView $rv){
        $this->userDAL = $userDAL;
        $this->registerView = $rv;
    }

    public function registrations(){
        if($this->registerView->checkDoRegistrationPost()){
            $username = $this->registerView->checkUserNamePost();
            $password = $this->registerView->checkPasswordPost();

            $user = $this->registerView->getUser();
            if($user != null){
                try {
                    $this->userDAL->save($user);
                } catch (Exception $e) {
                    $this->registerView->setDuplicate();
                }
            }
        }

    }
}
