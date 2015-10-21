<?php

namespace controller;

class DeleteFileController {
    private $logedInView;
    private $fileDAL;

    public function __construct(\view\LogedInView $lov, \model\fileDAL $fileDAL){
        $this->logedInView = $lov;
        $this->fileDAL = $fileDAL;
    }

    public function doDeleteFile(){
        $path = "";
        if($this->logedInView->checkDeletePost()){

            $checkt = $this->logedInView->getChecktCheckboxes();
            if($checkt != null){
                foreach ($checkt as $filename) {
                    $path = $this->fileDAL->getFilePath($filename);
                    $this->fileDAL->removeFile($path);
                }

            }
        }
    }

    public function getHTML(){
        return $this->view;
    }
}
