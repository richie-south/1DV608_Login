<?php

// TODO: require right stuff in here!

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

$htmlView = new \view\LayoutView();
$masterController = new \controller\MasterController();

$masterController->run();
$view = $masterController->generateOutput();
$nav = $masterController->generateNavigation();

$htmlView->renderHTMLPage($view, $nav);
