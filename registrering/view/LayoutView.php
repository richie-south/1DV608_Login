<?php

namespace view;

class LayoutView {

    public function __construct(\view\LoginView $v, \view\DateTimeView $dtv, \view\RegisterView $rv, \view\NavigationView $navView) {
        $this->loginView = $v;
        $this->dateTimeView = $dtv;
        $this->registerView = $rv;
        $this->navView = $navView;
    }

    public function render($isLoggedIn) {
        echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Login Example</title>
            </head>
            <body>
              <h1>Assignment 2</h1>
              '.$this->renderLink().'
              ' . $this->renderIsLoggedIn($isLoggedIn) . '

              <div class="container">
                  ' . $this->renderForm() . '

                  ' . $this->dateTimeView->show() . '
              </div>
             </body>
          </html>
        ';
    }

    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }

    private function renderForm(){
        if($this->navView->userWantsToRegistrate()){
            return $this->registerView->response();
        }
        return $this->loginView->response();
    }

    function renderLink(){
        if($this->navView->userWantsToRegistrate()){
            return $this->navView->getLinkToLogin();
        }
        return $this->navView->getLinkToRegistration();
    }
}
