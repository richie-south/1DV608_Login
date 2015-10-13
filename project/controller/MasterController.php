<?php

namespace controller;

require_once('view/NavigationView.php');
require_once('view/UploadView.php');
require_once('view/ShowFileView.php');

require_once('model/FileModel.php');
require_once('model/FileGetModel.php');

require_once('controller/FileUploadController.php');
require_once('controller/FileGetController.php');


class MasterController {

    private $navigationView;
    private $view;

    public function __construct(){
        $this->navigationView = new \view\NavigationView();
    }

    public function handelInput(){
        if($this->navigationView->userWantsToViewFile()){
            //var_dump($this->navigationView->getURLFileData());
            $FileGetModel =  new \model\FileGetModel();
            $showFileView = new \view\ShowFileView();
            $fileGet = new \controller\FileGetController($showFileView, $FileGetModel);


            $this->view = $showFileView->render($fileGet->getFileName($this->navigationView->getURLFileData()));

        } else {
            $fileModel = new \model\FileModel();
            $uploadView = new \view\UploadView();
            $fileUpload = new \controller\FileUploadController($uploadView, $fileModel);

            $this->view = $uploadView->render($fileUpload->doUpload());
        }
    }


    public function generateOutput(){
        return $this->view;
    }

}
