<?php


class LayoutView {
    private static $url = "?register";

    public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $rv) {
        echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Login Example</title>
            </head>
            <body>
              <h1>Assignment 2</h1>
              '.$this->renderLink($rv).'
              ' . $this->renderIsLoggedIn($isLoggedIn) . '

              <div class="container">
                  ' . $this->renderForm($v, $rv) . '

                  ' . $dtv->show() . '
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

    private function renderForm(LoginView $v, RegisterView $rv){
        if($rv->userWantsToRegistrat()){
            return $rv->response();
        }
        return $v->response();
    }

    function renderLink(RegisterView $rv){
        if($rv->userWantsToRegistrat()){
            return '<a href="?">Back to login</a>';
        }
        return '<a href='.self::$url.'>Register a new user</a>';
    }
}
