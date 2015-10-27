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
        if($this->logedInView->checkDeletePost()){

            $checkt = $this->logedInView->getChecktCheckboxes();
            if($checkt != null){
                $this->fileDAL->removeFilesFromName($checkt);
            }
        }
    }
}
