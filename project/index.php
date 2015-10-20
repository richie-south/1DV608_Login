<?php

//INCLUDE THE FILES NEEDED...
require_once('Settings.php');
// view
require_once('view/LayoutView.php');
// controller
require_once('controller/MasterController.php');

if(\Settings::DisplayError){
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

$navigationView = new \view\NavigationView();
$htmlView = new \view\LayoutView($navigationView);


$masterController = new \controller\MasterController($navigationView);
$masterController->run();
$view = $masterController->generateOutput();


$htmlView->renderHTMLPage($view);

// TODO: stop repost F5*∞
