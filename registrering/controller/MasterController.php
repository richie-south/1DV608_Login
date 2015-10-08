<?php

namespace controller;

require_once('Settings.php');

require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/NavigationView.php');


require_once('model/Login.php');
require_once('model/Session.php');
require_once('model/UserDAL.php');

require_once('controller/LoginControl.php');
require_once('controller/RegisterController.php');

class MasterController {

    private $UserDAL;
    private $navigationView;
    private $mysqli;

    public function __construct() {

        $this->mysqli = new \mysqli("richardsoderman.se", "root", "8uhOTD11Bf", "phplab4");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $this->UserDAL =  new \model\UserDAL($this->$mysqli);
        $this->navigationView = new \view\NavigationView();
    }



}
