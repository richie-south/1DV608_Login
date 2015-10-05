<?php

class RegisterController {

    private $registerView;

    public function __construct(RegisterView $rv){
        $this->registerView = $rv;
    }

    public function registrations(){
        if($this->registerView->userWantsToRegistrat()){
            return true;
        }
        return false;
    }
}
