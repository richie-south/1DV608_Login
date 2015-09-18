<?php

class LoginControl {

    private $loginModel;
    private $sessionModel;
    private $loginView;


    public function __construct(Login $loginModel, Session $session, LoginView $v){
        $this->loginModel = $loginModel;
        $this->sessionModel = $session;
        $this->loginView = $v;
    }

    /**
    *
    * checks is user posts, sets session and message
    * @return boolean
    */
    public function isLogedin(){
        if($this->sessionModel->isSessionSetTrue()){
            if($this->loginView->checkLogoutPost()){
                $this->sessionModel->destroySession();
                $this->loginModel->setMessage("Bye bye!");
                return false;
            }
            return true;
        }

        if($this->loginView->checkLoginPost()){
            $password = $this->loginView->getInputPassword();
            $userName = $this->loginView->getInputUsername();

            if($this->loginModel->checkValues($userName, $password)){
                $this->sessionModel->setSession(true);
                return true;
            }
        }

        $this->sessionModel->destroySession();
        $this->sessionModel->setSession(false);
        return false;
    }
}
