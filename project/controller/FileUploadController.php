<?php

namespace controller;

class FileUploadController {

    private $uploadView;
    //private $fileModel;
    private $DAL;
    private $view;

    public function __construct(\view\UploadView $up, \model\DAL $dal){
        $this->uploadView = $up;
        $this->DAL = $dal;
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
                        $this->uploadView->setUploadetFileURL($this->DAL->trimFilePath($path));
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
