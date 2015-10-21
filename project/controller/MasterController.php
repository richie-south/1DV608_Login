<?php

namespace controller;

// view
require_once('view/NavigationView.php');
require_once('view/UploadView.php');
require_once('view/ShowFileView.php');
require_once('view/LoginView.php');
require_once('view/LogedInView.php');

// model
require_once('model/FileModel.php');
require_once('model/UserModel.php');
require_once('model/UserDAL.php');
require_once('model/fileDAL.php');
require_once('model/SessionModel.php');

// controller
require_once('controller/FileUploadController.php');
require_once('controller/FileGetController.php');
require_once('controller/LoginController.php');
require_once('controller/LogoutController.php');
require_once('controller/DeleteFileController.php');

class MasterController {

    private $navigationView;
    private $view;
    private $fileDAL;
    private $userDAL;
    private $sessionModel;
    private $isLoggedin;

    public function __construct(\view\NavigationView $nav){
        $this->navigationView = $nav;
        $this->fileDAL =  new \model\fileDAL();
        $this->userDAL = new \model\UserDAL();
        $this->sessionModel = new \model\SessionModel();
    }

    public function run(){

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

            $loginController = new \controller\LoginController($loginView, $logedInView, $this->navigationView, $this->fileDAL, $this->userDAL, $this->sessionModel);

            $loginController->doLogin();
            $this->view = $loginController->getHTML();

            // TODO: if admin wants to remove file.


        } else if ($this->navigationView->userWantsToLogout()){
            $logoutController = new \controller\LogoutController($this->navigationView, $this->sessionModel);
            $logoutController->doLogout();
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

}
