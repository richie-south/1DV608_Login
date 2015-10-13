<?php

namespace controller;

class FileUploadController {

    private $uploadView;
    private $fileModel;

    public function __construct(\view\UploadView $up, \model\FileModel $fileModel){
        $this->uploadView = $up;
        $this->fileModel = $fileModel;
    }

    public function doUpload(){

        if($this->uploadView->isFileUploaded())
        {

            if($this->fileModel->isUploaded()){
                do{
                    $fileName = $this->fileModel->generateFileName();
                }while($this->fileModel->isSame($fileName));

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
