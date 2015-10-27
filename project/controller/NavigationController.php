<?php

namespace controller;

class NavigationController{

    private $navigationView;
    private $sessionView;
    private $navigation;

    public function __construct(\view\NavigationView $nav, \view\SessionView $sv){
        $this->navigationView = $nav;
        $this->sessionView = $sv;
    }

    public function doNavigationControlls(){
        if($this->sessionView->isLogedInSessionSet()){
            if($this->navigationView->userWantsToLogin()){
                $this->navigation = $this->navigationView->backToStartNav();
            }else{
                $this->navigation = $this->navigationView->adminPage();
            }
        }else{
            if($this->navigationView->userWantsToLogin()){
                $this->navigation = $this->navigationView->backToStartNav();
            }else{
                $this->navigation = $this->navigationView->loginPage();
            }
        }
    }

    public function getNavigationHTML(){
        return $this->navigation;
    }
}
