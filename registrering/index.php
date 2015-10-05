<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');


require_once('model/Login.php');
require_once('model/Session.php');

require_once('controller/LoginControl.php');
require_once('controller/RegisterController.php');
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE MODEL
$login = new Login();
$session = new Session();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($login, $session);
$dtv = new DateTimeView();
$lv = new LayoutView();
$rv = new RegisterView();

// CREATE OBJECTS OF THE CONTROLLER
$lc = new LoginControl($login, $session, $v);
$rc = new RegisterController($rv);

//$rc->registrations();
$lv->render($lc->isLogedin(), $v, $dtv, $rv);
