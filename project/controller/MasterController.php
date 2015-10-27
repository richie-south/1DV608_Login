<?php

namespace controller;

// view
require_once('view/NavigationView.php');
require_once('view/UploadView.php');
require_once('view/ShowFileView.php');
require_once('view/LoginView.php');
require_once('view/LogedInView.php');
require_once('view/SessionView.php');

// model
require_once('model/FileModel.php');
require_once('model/UserModel.php');
require_once('model/UserDAL.php');
require_once('model/fileDAL.php');

// controller
require_once('controller/FileUploadController.php');
require_once('controller/FileGetController.php');
require_once('controller/LoginController.php');
require_once('controller/LogoutController.php');
require_once('controller/DeleteFileController.php');
require_once('controller/NavigationController.php');

class MasterController {

    private $navigationView;
    private $view;
    private $fileDAL;
    private $userDAL;
    private $sessionView;
    private $isLoggedin;
    private $navigationController;

    public function __construct(){
        $this->navigationView = new \view\NavigationView();
        $this->fileDAL =  new \model\fileDAL();
        $this->userDAL = new \model\UserDAL();
        $this->sessionView = new \view\SessionView();
        $this->navigationController = new \controller\NavigationController($this->navigationView, $this->sessionView);
    }

    public function run(){
        $this->navigationController->doNavigationControlls();

        if($this->navigationView->userWantsToViewFile()){
            $showFileView = new \view\ShowFileView($this->fileDAL);
            $fileGet = new \controller\FileGetController($showFileView);

            $fileGet->getFile($this->navigationView->getURLFileData());
            $this->view = $fileGet->getHTML();

        } else if($this->navigationView->userWantsToLogin()){
            $loginView = new \view\LoginView($this->userDAL);
            $logedInView = new \view\LogedInView($this->navigationView);

            $deletefileController = new \controller\DeleteFileController($logedInView, $this->fileDAL);
            $deletefileController->doDeleteFile();

            $loginController = new \controller\LoginController($loginView, $logedInView, $this->fileDAL, $this->sessionView);
            $loginController->doLogin();

            $logoutController = new \controller\LogoutController($logedInView, $this->navigationView, $this->sessionView);
            $logoutController->doLogout();

            $this->view = $loginController->getHTML();
        }else {
            $uploadView = new \view\UploadView($this->fileDAL);
            $fileUpload = new \controller\FileUploadController($uploadView, $this->fileDAL, $this->navigationView);

            $fileUpload->doUpload();
            $this->view = $fileUpload->getHTML();
        }
    }

    public function generateOutput(){
        return $this->view;
    }

    public function generateNavigation(){
        return $this->navigationController->getNavigationHTML();
    }

}
