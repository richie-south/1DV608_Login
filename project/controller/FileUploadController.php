<?php

namespace controller;

class FileUploadController {

    private $uploadView;
    private $fileModel;
    private $DAL;
    //private $uploadedFilePath;

    public function __construct(\view\UploadView $up, \model\FileModel $fileModel, \model\DAL $dal){
        $this->uploadView = $up;
        $this->fileModel = $fileModel;
        $this->DAL = $dal;
    }

    public function doUpload(){

        if($this->uploadView->isFileUploaded())
        {
            if($this->fileModel->isTempUploaded()){
                do{
                    $fileName = $this->fileModel->generateFileName();
                }while($this->DAL->isSame($fileName));

                $file = $this->fileModel->getFileToUpload();
                $path = $this->DAL->makeFilePath($fileName);

                if($this->DAL->uploadFile($file, $path)){
                    $this->uploadView->setUploadetFileURL($this->fileModel->trimFilePath($path));
                    return true;
                }

            }else {
                // TODO: This!
                echo "error";
            }
        }
        return false;
    }
}
