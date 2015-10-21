<?php

namespace controller;

class LogoutController {

    private $navigationView;
    private $sessionModel;

    public function __construct(\view\NavigationView $nav, \model\SessionModel $sm){
        $this->navigationView = $nav;
        $this->sessionModel = $sm;
    }

    public function doLogout(){
        $this->sessionModel->destroyLogedInSession();
        $this->navigationView->redirectToStart();

    }

    public function getHTML(){
        return $this->view;
    }
}
