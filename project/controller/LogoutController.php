<?php

namespace controller;

class LogoutController {

    private $logedinView;
    private $navigationView;
    private $sessionView;

    public function __construct(\view\LogedInView $lov, \view\NavigationView $nav, \view\SessionView $sv){
        $this->logedinView = $lov;
        $this->navigationView = $nav;
        $this->sessionView = $sv;
    }

    public function doLogout(){
        if($this->logedinView->checkLogoutPost()){
            $this->sessionView->destroyLogedInSession();
            $this->navigationView->redirectToStart();
        }
    }
}
