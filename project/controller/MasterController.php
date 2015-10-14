<?php

namespace controller;

require_once('view/NavigationView.php');
require_once('view/UploadView.php');
require_once('view/ShowFileView.php');

require_once('model/FileModel.php');
require_once('model/DAL.php');

require_once('controller/FileUploadController.php');
require_once('controller/FileGetController.php');

class MasterController {

    private $navigationView;
    private $view;
    private $DAL;

    public function __construct(){
        $this->navigationView = new \view\NavigationView();
        $this->DAL =  new \model\DAL();
    }

    public function handelInput(){

        if($this->navigationView->userWantsToViewFile()){
            $showFileView = new \view\ShowFileView($this->DAL);
            $fileGet = new \controller\FileGetController($showFileView);

            $fileGet->getFile($this->navigationView->getURLFileData());
            $this->view = $fileGet->getHTML();
        } else {

            $uploadView = new \view\UploadView($this->DAL);
            $fileUpload = new \controller\FileUploadController($uploadView, $this->DAL);
            $fileUpload->doUpload();
            $this->view = $fileUpload->getHTML();
        }
    }


    public function generateOutput(){
        return $this->view;
    }

}
