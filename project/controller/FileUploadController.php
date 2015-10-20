<?php

namespace controller;

class FileUploadController {

    private $uploadView;
    private $DAL;
    private $view;
    private $navigationView;

    public function __construct(\view\UploadView $up, \model\fileDAL $dal, \view\NavigationView $nav){
        $this->uploadView = $up;
        $this->DAL = $dal;
        $this->navigationView = $nav;
    }

    public function doUpload(){
        if($this->uploadView->isFileUploaded()){
            $fileModel = $this->uploadView->getFile();
            if($fileModel != null){
                if($this->DAL->isTempUploaded($fileModel->getFile())){
                    // TODO: move [do while] to model
                    do{
                        $fileName = $fileModel->generateFileName();
                    }while($this->DAL->isSame($fileName));
                    $path = $this->DAL->makeFilePath($fileName);

                    if($this->DAL->uploadFile($fileModel->getFile(), $path)){
                        $URL = $this->navigationView->makeFileNameUrl($this->DAL->trimFilePath($path));
                        $this->uploadView->setUploadetFileURL($URL);
                        $this->view = $this->uploadView->linkRender();
                    }
                }

            }else{
                $this->view = $this->uploadView->errorPageRender();
            }
        }else{
            $this->view = $this->uploadView->fileUploadRender();
        }
    }

    public function getHTML(){
        return $this->view;
    }
}
