<?php

namespace controller;

class FileUploadController {

    private $uploadView;
    private $fileModel;
    private $DAL;

    public function __construct(\view\UploadView $up, \model\FileModel $fileModel, \model\DAL $dal){
        $this->uploadView = $up;
        $this->fileModel = $fileModel;
        $this->DAL = $dal;
    }

    public function doUpload(){

        if($this->uploadView->isFileUploaded())
        {

            if($this->fileModel->isUploaded()){
                do{
                    $fileName = $this->fileModel->generateFileName();
                }while($this->DAL->isSame($fileName));

                $path = $this->fileModel->getFilePath($fileName);

                if($this->fileModel->moveUploadeFile($path)){
                    return true;
                }

            }
            return false;
        }
        return false;
    }
}
