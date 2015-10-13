<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LayoutView.php');

require_once('controller/MasterController.php');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$masterController = new \controller\MasterController();

$masterController->handelInput();
$view = $masterController->generateOutput();

$htmlView = new \view\LayoutView();

// TODO: make title changeable
$htmlView->renderHTMLPage("project", $view);
