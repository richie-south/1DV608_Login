<?php

//INCLUDE THE FILES NEEDED...
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
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE MODEL
$userDAL = new \model\UserDAL();
$login = new Login($userDAL);
$session = new Session();

$userDAL->connect();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($login, $session);
$dtv = new DateTimeView();

$rv = new RegisterView();
$navView = new \view\NavigationView();
$lv = new LayoutView($v, $dtv, $rv, $navView);

// CREATE OBJECTS OF THE CONTROLLER
$lc = new LoginControl($login, $session, $v, $userDAL);
$rc = new RegisterController($userDAL, $rv, $session, $navView);

$rc->registrations();
$lv->render($lc->isLogedin());
